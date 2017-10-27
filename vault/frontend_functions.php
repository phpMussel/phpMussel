<?php
/**
 * This file is a part of the phpMussel package.
 * Homepage: https://phpmussel.github.io/
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * Authors:
 * @see PEOPLE.md
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Front-end functions file (last modified: 2017.10.27).
 */

/**
 * Validates or ensures that two different sets of component metadata share the
 * same base elements (or components). One set acts as a model for which base
 * elements are expected, and if additional/superfluous entries are found in
 * the other set (the base), they'll be removed. Installed components are
 * ignored as to future-proof legacy support (just removes non-installed
 * components).
 *
 * @param string $Base The base set (generally, the local copy).
 * @param string $Model The model set (generally, the remote copy).
 * @param bool $Validate Validate (true) or ensure congruency (false; default).
 * @return string|bool If $Validate is true, returns true|false according to
 *      whether the sets are congruent. If $Validate is false, returns the
 *      corrected $Base set.
 */
$phpMussel['Congruency'] = function ($Base, $Model, $Validate = false) use (&$phpMussel) {
    if (empty($Base) || empty($Model)) {
        return $Validate ? false : '';
    }
    $BaseArr = $ModelArr = [];
    $phpMussel['YAML']($Base, $BaseArr);
    $phpMussel['YAML']($Model, $ModelArr);
    foreach ($BaseArr as $Element => $Data) {
        if (!isset($Data['Version']) && !isset($Data['Files']) && !isset($ModelArr[$Element])) {
            if ($Validate) {
                return false;
            }
            $Base = preg_replace("~\n" . $Element . ":?(\n [^\n]*)*\n~i", "\n", $Base);
        }
    }
    return $Validate ? true : $Base;
};

/**
 * Can be used to delete some files via the front-end.
 *
 * @param string $File The file to delete.
 * @return bool Success or failure.
 */
$phpMussel['Delete'] = function ($File) use (&$phpMussel) {
    if (!empty($File) && file_exists($phpMussel['Vault'] . $File) && $phpMussel['Traverse']($File)) {
        if (!unlink($phpMussel['Vault'] . $File)) {
            return false;
        }
        $phpMussel['DeleteDirectory']($File);
        return true;
    }
    return false;
};

/**
 * Can be used to delete some empty directories via the front-end.
 *
 * @param string $Dir The directory to delete.
 */
$phpMussel['DeleteDirectory'] = function ($Dir) use (&$phpMussel) {
    while (strrpos($Dir, '/') !== false || strrpos($Dir, "\\") !== false) {
        $Separator = (strrpos($Dir, '/') !== false) ? '/' : "\\";
        $Dir = substr($Dir, 0, strrpos($Dir, $Separator));
        if (is_dir($phpMussel['Vault'] . $Dir) && $phpMussel['FileManager-IsDirEmpty']($phpMussel['Vault'] . $Dir)) {
            rmdir($phpMussel['Vault'] . $Dir);
        } else {
            break;
        }
    }
};

/**
 * Adds integer values; Returns zero if the sum total is negative or if any
 * contained values aren't integers, and otherwise, returns the sum total.
 */
$phpMussel['ZeroMin'] = function () {
    $Sum = 0;
    foreach (func_get_args() as $Value) {
        $IntValue = (int)$Value;
        if ($IntValue !== $Value) {
            return 0;
        }
        $Sum += $IntValue;
    }
    return $Sum < 0 ? 0 : $Sum;
};

/** Format filesize information. */
$phpMussel['FormatFilesize'] = function (&$Filesize) use (&$phpMussel) {
    $Scale = ['field_size_bytes', 'field_size_KB', 'field_size_MB', 'field_size_GB', 'field_size_TB'];
    $Iterate = 0;
    $Filesize = (int)$Filesize;
    while ($Filesize > 1024) {
        $Filesize = $Filesize / 1024;
        $Iterate++;
        if ($Iterate > 4) {
            break;
        }
    }
    $Filesize = $phpMussel['Number_L10N']($Filesize, ($Iterate === 0) ? 0 : 2) . ' ' . $phpMussel['Plural']($Filesize, $phpMussel['lang'][$Scale[$Iterate]]);
};

/**
 * Remove an entry from the front-end cache data.
 *
 * @param string $Source Variable containing cache file data.
 * @param bool $Rebuild Flag indicating to rebuild cache file.
 * @param string $Entry Name of the cache entry to be deleted.
 */
$phpMussel['FECacheRemove'] = function (&$Source, &$Rebuild, $Entry) {
    $Entry64 = base64_encode($Entry);
    while (($EntryPos = strpos($Source, "\n" . $Entry64 . ',')) !== false) {
        $EoL = strpos($Source, "\n", $EntryPos + 1);
        if ($EoL !== false) {
            $Line = substr($Source, $EntryPos, $EoL - $EntryPos);
            $Source = str_replace($Line, '', $Source);
            $Rebuild = true;
        }
    }
};

/**
 * Add an entry to the front-end cache data.
 *
 * @param string $Source Variable containing cache file data.
 * @param bool $Rebuild Flag indicating to rebuild cache file.
 * @param string $Entry Name of the cache entry to be added.
 * @param string $Data Cache entry data (what should be cached).
 * @param int $Expires When should the cache entry expire (be deleted).
 */
$phpMussel['FECacheAdd'] = function (&$Source, &$Rebuild, $Entry, $Data, $Expires) use (&$phpMussel) {
    $phpMussel['FECacheRemove']($Source, $Rebuild, $Entry);
    $Expires = (int)$Expires;
    $NewLine = base64_encode($Entry) . ',' . base64_encode($Data) . ',' . $Expires . "\n";
    $Source .= $NewLine;
    $Rebuild = true;
};

/**
 * Get an entry from the front-end cache data.
 *
 * @param string $Source Variable containing cache file data.
 * @param bool $Rebuild Flag indicating to rebuild cache file.
 * @param string $Entry Name of the cache entry to get.
 * return string|bool Returned cache entry data (or false on failure).
 */
$phpMussel['FECacheGet'] = function ($Source, $Entry) {
    $Entry = base64_encode($Entry);
    $EntryPos = strpos($Source, "\n" . $Entry . ',');
    if ($EntryPos !== false) {
        $EoL = strpos($Source, "\n", $EntryPos + 1);
        if ($EoL !== false) {
            $Line = substr($Source, $EntryPos, $EoL - $EntryPos);
            $Entry = explode(',', $Line);
            if (!empty($Entry[1])) {
                return base64_decode($Entry[1]);
            }
        }
    }
    return false;
};

/**
 * Compare two different versions of phpMussel, or two different versions of a
 * component for phpMussel, to see which is newer (mostly used by the updater).
 *
 * @param string $A The 1st version string.
 * @param string $B The 2nd version string.
 * return bool True if the 2nd version is newer than the 1st version, and false
 *      otherwise (i.e., if they're the same, or if the 1st version is newer).
 */
$phpMussel['VersionCompare'] = function ($A, $B) {
    $Normalise = function (&$Ver) {
        $Ver =
            preg_match('~^v?([0-9]+)$~i', $Ver, $Matches) ?:
            preg_match('~^v?([0-9]+)\.([0-9]+)$~i', $Ver, $Matches) ?:
            preg_match('~^v?([0-9]+)\.([0-9]+)\.([0-9]+)(RC[0-9]{1,2}|-[0-9a-z_+\\/]+)?$~i', $Ver, $Matches) ?:
            preg_match('~^([0-9]{1,4})[.-]([0-9]{1,2})[.-]([0-9]{1,4})(RC[0-9]{1,2}|[.+-][0-9a-z_+\\/]+)?$~i', $Ver, $Matches) ?:
            preg_match('~^([a-z]+)-([0-9a-z]+)-([0-9a-z]+)$~i', $Ver, $Matches);
        $Ver = [
            'Major' => isset($Matches[1]) ? $Matches[1] : 0,
            'Minor' => isset($Matches[2]) ? $Matches[2] : 0,
            'Patch' => isset($Matches[3]) ? $Matches[3] : 0,
            'Build' => isset($Matches[4]) ? substr($Matches[4], 1) : 0
        ];
        $Ver = array_map(function ($Var) {
            $VarInt = (int)$Var;
            $VarLen = strlen($Var);
            if ($Var == $VarInt && strlen($VarInt) === $VarLen && $VarLen > 1) {
                return $VarInt;
            }
            return strtolower($Var);
        }, $Ver);
    };
    $Normalise($A);
    $Normalise($B);
    return (
        $B['Major'] > $A['Major'] || (
            $B['Major'] === $A['Major'] &&
            $B['Minor'] > $A['Minor']
        ) || (
            $B['Major'] === $A['Major'] &&
            $B['Minor'] === $A['Minor'] &&
            $B['Patch'] > $A['Patch']
        ) || (
            $B['Major'] === $A['Major'] &&
            $B['Minor'] === $A['Minor'] &&
            $B['Patch'] === $A['Patch'] &&
            !empty($A['Build']) && (
                empty($B['Build']) || $B['Build'] > $A['Build']
            )
        )
    );
};

/**
 * Remove sub-arrays from an array.
 *
 * @param array $Arr An array.
 * return array An array.
 */
$phpMussel['ArrayFlatten'] = function ($Arr) {
    return array_filter($Arr, function () {
        return (!is_array(func_get_args()[0]));
    });
};

/** Isolate a L10N array down to a single relevant L10N string. */
$phpMussel['IsolateL10N'] = function (&$Arr, $Lang) {
    if (isset($Arr[$Lang])) {
        $Arr = $Arr[$Lang];
    } elseif (isset($Arr['en'])) {
        $Arr = $Arr['en'];
    } else {
        $Key = key($Arr);
        $Arr = $Arr[$Key];
    }
};

/**
 * Append one or two values to a string, depending on whether that string is
 * empty prior to calling the closure (allows cleaner code in some areas).
 *
 * @param string $String The string to work with.
 * @param string $Delimit Appended first, if the string is not empty.
 * @param string $Append Appended second, and always (empty or otherwise).
 */
$phpMussel['AppendToString'] = function (&$String, $Delimit = '', $Append = '') {
    if (!empty($String)) {
        $String .= $Delimit;
    }
    $String .= $Append;
};

/**
 * Used by the file manager to generate a list of the files contained in a
 * working directory (normally, the vault).
 *
 * @param string $Base The path to the working directory.
 * @return array A list of the files contained in the working directory.
 */
$phpMussel['FileManager-RecursiveList'] = function ($Base) use (&$phpMussel) {
    $Arr = [];
    $Key = -1;
    $Offset = strlen($Base);
    $List = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($Base), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($List as $Item => $List) {
        $Key++;
        $ThisName = substr($Item, $Offset);
        if (preg_match('~^(?:/\.\.|./\.|\.{3})$~', str_replace("\\", '/', substr($Item, -3)))) {
            continue;
        }
        $Arr[$Key] = ['Filename' => $ThisName];
        if (is_dir($Item)) {
            $Arr[$Key]['CanEdit'] = false;
            $Arr[$Key]['Directory'] = true;
            $Arr[$Key]['Filesize'] = 0;
            $Arr[$Key]['Filetype'] = $phpMussel['lang']['field_filetype_directory'];
            $Arr[$Key]['Icon'] = 'icon=directory';
        } elseif (is_file($Item)) {
            $Arr[$Key]['CanEdit'] = true;
            $Arr[$Key]['Directory'] = false;
            $Arr[$Key]['Filesize'] = filesize($Item);
            if (isset($phpMussel['FE']['TotalSize'])) {
                $phpMussel['FE']['TotalSize'] += $Arr[$Key]['Filesize'];
            }
            if (isset($phpMussel['Components']['Components'])) {
                $Component = $phpMussel['lang']['field_filetype_unknown'];
                $ThisNameFixed = str_replace("\\", '/', $ThisName);
                if (isset($phpMussel['Components']['Files'][$ThisNameFixed])) {
                    if (!empty($phpMussel['Components']['Names'][$phpMussel['Components']['Files'][$ThisNameFixed]])) {
                        $Component = $phpMussel['Components']['Names'][$phpMussel['Components']['Files'][$ThisNameFixed]];
                    } else {
                        $Component = $phpMussel['Components']['Files'][$ThisNameFixed];
                    }
                    if ($Component === 'phpMussel') {
                        $Component .= ' (' . $phpMussel['lang']['field_component'] . ')';
                    }
                } elseif (substr($ThisNameFixed, -10) === 'config.ini') {
                    $Component = $phpMussel['lang']['link_config'];
                } else {
                    $LastFour = strtolower(substr($ThisNameFixed, -4));
                    if (
                        $LastFour === '.tmp' ||
                        $ThisNameFixed === 'index.dat' ||
                        $ThisNameFixed === 'fe_assets/frontend.dat' ||
                        substr($ThisNameFixed, -9) === '.rollback'
                    ) {
                        $Component = $phpMussel['lang']['label_fmgr_cache_data'];
                    } elseif ($LastFour === '.log' || $LastFour === '.txt') {
                        $Component = $phpMussel['lang']['link_logs'];
                    } elseif ($LastFour === '.qfu') {
                        $Component = $phpMussel['lang']['label_quarantined'];
                    } elseif (preg_match('/^\.(?:dat|inc|ya?ml)$/i', $LastFour)) {
                        $Component = $phpMussel['lang']['label_fmgr_updates_metadata'];
                    }
                }
                if (!isset($phpMussel['Components']['Components'][$Component])) {
                    $phpMussel['Components']['Components'][$Component] = 0;
                }
                $phpMussel['Components']['Components'][$Component] += $Arr[$Key]['Filesize'];
            }
            if (($ExtDel = strrpos($Item, '.')) !== false) {
                $Ext = strtoupper(substr($Item, $ExtDel + 1));
                if (!$Ext) {
                    $Arr[$Key]['Filetype'] = $phpMussel['lang']['field_filetype_unknown'];
                    $Arr[$Key]['Icon'] = 'icon=unknown';
                    $phpMussel['FormatFilesize']($Arr[$Key]['Filesize']);
                    continue;
                }
                $Arr[$Key]['Filetype'] = $phpMussel['ParseVars'](['EXT' => $Ext], $phpMussel['lang']['field_filetype_info']);
                if ($Ext === 'ICO') {
                    $Arr[$Key]['Icon'] = 'file=' . urlencode($Prepend . $Item);
                    $phpMussel['FormatFilesize']($Arr[$Key]['Filesize']);
                    continue;
                }
                if (preg_match(
                    '/^(?:.?[BGL]Z.?|7Z|A(CE|LZ|P[KP]|R[CJ]?)?|B([AH]|Z2?)|CAB|DMG|' .
                    'I(CE|SO)|L(HA|Z[HOWX]?)|P(AK|AQ.?|CK|EA)|RZ|S(7Z|EA|EN|FX|IT.?|QX)|' .
                    'X(P3|Z)|YZ1|Z(IP.?|Z)?|(J|M|PH|R|SH|T|X)AR)$/'
                , $Ext)) {
                    $Arr[$Key]['CanEdit'] = false;
                    $Arr[$Key]['Icon'] = 'icon=archive';
                } elseif (preg_match('/^[SDX]?HT[AM]L?$/', $Ext)) {
                    $Arr[$Key]['Icon'] = 'icon=html';
                } elseif (preg_match('/^(?:CSV|JSON|NEON|SQL|YAML)$/', $Ext)) {
                    $Arr[$Key]['Icon'] = 'icon=ods';
                } elseif (preg_match('/^(?:PDF|XDP)$/', $Ext)) {
                    $Arr[$Key]['CanEdit'] = false;
                    $Arr[$Key]['Icon'] = 'icon=pdf';
                } elseif (preg_match('/^DOC[XT]?$/', $Ext)) {
                    $Arr[$Key]['CanEdit'] = false;
                    $Arr[$Key]['Icon'] = 'icon=doc';
                } elseif (preg_match('/^XLS[XT]?$/', $Ext)) {
                    $Arr[$Key]['CanEdit'] = false;
                    $Arr[$Key]['Icon'] = 'icon=xls';
                } elseif (preg_match('/^(?:CSS|JS|OD[BFGPST]|P(HP|PT))$/', $Ext)) {
                    $Arr[$Key]['Icon'] = 'icon=' . strtolower($Ext);
                    if (!preg_match('/^(?:CSS|JS|PHP)$/', $Ext)) {
                        $Arr[$Key]['CanEdit'] = false;
                    }
                } elseif (preg_match('/^(?:FLASH|SWF)$/', $Ext)) {
                    $Arr[$Key]['CanEdit'] = false;
                    $Arr[$Key]['Icon'] = 'icon=swf';
                } elseif (preg_match(
                    '/^(?:BM[2P]|C(D5|GM)|D(IB|W[FG]|XF)|ECW|FITS|GIF|IMG|J(F?IF?|P[2S]|PE?G?2?|XR)|P(BM|CX|DD|GM|IC|N[GMS]|PM|S[DP])|S(ID|V[AG])|TGA|W(BMP?|EBP|MP)|X(CF|BMP))$/'
                , $Ext)) {
                    $Arr[$Key]['CanEdit'] = false;
                    $Arr[$Key]['Icon'] = 'icon=image';
                } elseif (preg_match(
                    '/^(?:H?264|3GP(P2)?|A(M[CV]|VI)|BIK|D(IVX|V5?)|F([4L][CV]|MV)|GIFV|HLV|' .
                    'M(4V|OV|P4|PE?G[4V]?|KV|VR)|OGM|V(IDEO|OB)|W(EBM|M[FV]3?)|X(WMV|VID))$/'
                , $Ext)) {
                    $Arr[$Key]['CanEdit'] = false;
                    $Arr[$Key]['Icon'] = 'icon=video';
                } elseif (preg_match(
                    '/^(?:3GA|A(AC|IFF?|SF|U)|CDA|FLAC?|M(P?4A|IDI|KA|P[A23])|OGG|PCM|' .
                    'R(AM?|M[AX])|SWA|W(AVE?|MA))$/'
                , $Ext)) {
                    $Arr[$Key]['CanEdit'] = false;
                    $Arr[$Key]['Icon'] = 'icon=audio';
                } elseif (preg_match('/^(?:MD|NFO|RTF|TXT)$/', $Ext)) {
                    $Arr[$Key]['Icon'] = 'icon=text';
                }
            } else {
                $Arr[$Key]['Filetype'] = $phpMussel['lang']['field_filetype_unknown'];
            }
        }
        if (empty($Arr[$Key]['Icon'])) {
            $Arr[$Key]['Icon'] = 'icon=unknown';
        }
        if ($Arr[$Key]['Filesize']) {
            $phpMussel['FormatFilesize']($Arr[$Key]['Filesize']);
        } else {
            $Arr[$Key]['Filesize'] = '';
        }
    }
    return $Arr;
};

/**
 * Used by the file manager and the updates pages to fetch the components list.
 *
 * @param string $Base The path to the working directory.
 * @param array $Arr The array to use for rendering components file YAML data.
 */
$phpMussel['FetchComponentsLists'] = function ($Base, &$Arr) use (&$phpMussel) {
    $Files = new DirectoryIterator($Base);
    foreach ($Files as $ThisFile) {
        if (!empty($ThisFile) && preg_match('/\.(?:dat|inc|ya?ml)$/i', $ThisFile)) {
            $Data = $phpMussel['ReadFile']($Base . $ThisFile);
            if (substr($Data, 0, 4) === "---\n" && ($EoYAML = strpos($Data, "\n\n")) !== false) {
                $phpMussel['YAML'](substr($Data, 4, $EoYAML - 4), $Arr);
            }
        }
    }
};

/**
 * Checks paths for directory traversal and ensures that they only contain
 * expected characters.
 *
 * @param string $Path The path to check.
 * @return bool False when directory traversals and/or unexpected characters
 *      are detected, and true otherwise.
 */
$phpMussel['FileManager-PathSecurityCheck'] = function ($Path) {
    $Path = str_replace("\\", '/', $Path);
    if (
        preg_match('~(?://|[^!0-9A-Za-z\._-]$)~', $Path) ||
        preg_match('~^(?:/\.\.|./\.|\.{3})$~', str_replace("\\", '/', substr($Path, -3)))
    ) {
        return false;
    }
    $Path = preg_split('@/@', $Path, -1, PREG_SPLIT_NO_EMPTY);
    $Valid = true;
    array_walk($Path, function($Segment) use (&$Valid) {
        if (empty($Segment) || preg_match('/(?:[\x00-\x1f\x7f]+|^\.+$)/i', $Segment)) {
            $Valid = false;
        }
    });
    return $Valid;
};

/**
 * Checks whether the specified directory is empty.
 *
 * @param string $Directory The directory to check.
 * @return bool True if empty; False if not empty.
 */
$phpMussel['FileManager-IsDirEmpty'] = function ($Directory) {
    return !((new \FilesystemIterator($Directory))->valid());
};

/**
 * Used by the logs viewer to generate a list of the logfiles contained in a
 * working directory (normally, the vault).
 *
 * @param string $Base The path to the working directory.
 * @return array A list of the logfiles contained in the working directory.
 */
$phpMussel['Logs-RecursiveList'] = function ($Base) use (&$phpMussel) {
    $Arr = [];
    $List = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($Base), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($List as $Item => $List) {
        if (
            preg_match('~^(?:/\.\.|./\.|\.{3})$~', str_replace("\\", '/', substr($Item, -3))) ||
            !preg_match('~(?:logfile|\.(txt|log)$)~i', $Item) ||
            !is_file($Item) ||
            !is_readable($Item) ||
            is_dir($Item)
        ) {
            continue;
        }
        $ThisName = substr($Item, strlen($Base));
        $Arr[$ThisName] = ['Filename' => $ThisName, 'Filesize' => filesize($Item)];
        $phpMussel['FormatFilesize']($Arr[$ThisName]['Filesize']);
    }
    return $Arr;
};

/**
 * Checks whether a component is in use (front-end closure).
 *
 * @param array $Files The list of files to be checked.
 * @return bool Returns true (in use) or false (not in use).
 */
$phpMussel['IsInUse'] = function ($Files) use (&$phpMussel) {
    foreach ($Files as $File) {
        if (
            substr($File, 0, 11) === 'signatures/' &&
            strpos(',' . $phpMussel['Config']['signatures']['Active'] . ',', ',' . substr($File, 11) . ',') !== false
        ) {
            return true;
        }
    }
    return false;
};

/** Fetch remote data (front-end updates page). */
$phpMussel['FetchRemote'] = function () use (&$phpMussel) {
    $phpMussel['Components']['ThisComponent']['RemoteData'] = $phpMussel['FECacheGet'](
        $phpMussel['FE']['Cache'],
        $phpMussel['Components']['ThisComponent']['Remote']
    );
    if (!$phpMussel['Components']['ThisComponent']['RemoteData']) {
        $phpMussel['Components']['ThisComponent']['RemoteData'] = $phpMussel['Request']($phpMussel['Components']['ThisComponent']['Remote']);
        if (
            strtolower(substr($phpMussel['Components']['ThisComponent']['Remote'], -2)) === 'gz' &&
            substr($phpMussel['Components']['ThisComponent']['RemoteData'], 0, 2) === "\x1f\x8b"
        ) {
            $phpMussel['Components']['ThisComponent']['RemoteData'] = gzdecode($phpMussel['Components']['ThisComponent']['RemoteData']);
        }
        if (empty($phpMussel['Components']['ThisComponent']['RemoteData'])) {
            $phpMussel['Components']['ThisComponent']['RemoteData'] = '-';
        }
        $phpMussel['FECacheAdd'](
            $phpMussel['FE']['Cache'],
            $phpMussel['FE']['Rebuild'],
            $phpMussel['Components']['ThisComponent']['Remote'],
            $phpMussel['Components']['ThisComponent']['RemoteData'],
            $phpMussel['Time'] + 3600
        );
    }
};

/** Prepares component extended description (front-end updates page). */
$phpMussel['PrepareExtendedDescription'] = function (&$Arr, $Key = '') use (&$phpMussel) {
    $Key = 'Extended Description: ' . $Key;
    if (isset($phpMussel['lang'][$Key])) {
        $Arr['Extended Description'] = $phpMussel['lang'][$Key];
    } elseif (empty($Arr['Extended Description'])) {
        $Arr['Extended Description'] = '';
    }
    if (is_array($Arr['Extended Description'])) {
        $phpMussel['IsolateL10N']($Arr['Extended Description'], $phpMussel['Config']['general']['lang']);
    }
};

/** Prepares component name (front-end updates page). */
$phpMussel['PrepareName'] = function (&$Arr, $Key = '') use (&$phpMussel) {
    $Key = 'Name: ' . $Key;
    if (isset($phpMussel['lang'][$Key])) {
        $Arr['Name'] = $phpMussel['lang'][$Key];
    } elseif (empty($Arr['Name'])) {
        $Arr['Name'] = '';
    }
    if (is_array($Arr['Name'])) {
        $phpMussel['IsolateL10N']($Arr['Name'], $phpMussel['Config']['general']['lang']);
    }
};

/** Duplication avoidance (front-end updates page). */
$phpMussel['ComponentFunctionUpdatePrep'] = function () use (&$phpMussel) {
    if (!empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files'])) {
        $phpMussel['Arrayify']($phpMussel['Components']['Meta'][$_POST['ID']]['Files']);
        $phpMussel['Arrayify']($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To']);
        $phpMussel['Components']['Meta'][$_POST['ID']]['Files']['InUse'] =
            $phpMussel['IsInUse']($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To']);
    }
};

/**
 * Filter the available language options provided by the configuration page on
 * the basis of the availability of the corresponding language files.
 *
 * @param string $ChoiceKey Language code.
 * @return bool Valid/Invalid.
 */
$phpMussel['FilterLang'] = function ($ChoiceKey) use (&$phpMussel) {
    $Path = $phpMussel['Vault'] . 'lang/lang.' . $ChoiceKey;
    return (file_exists($Path . '.php') && file_exists($Path . '.fe.php'));
};

/**
 * Filter the available hash algorithms provided by the configuration page on
 * the basis of their availability.
 *
 * @param string $ChoiceKey Hash algorithm.
 * @return bool Valid/Invalid.
 */
$phpMussel['FilterAlgo'] = function ($ChoiceKey) use (&$phpMussel) {
    return ($ChoiceKey === 'PASSWORD_ARGON2I') ? !$phpMussel['VersionCompare'](PHP_VERSION, '7.2.0RC1') : true;
};

/**
 * Filter the available theme options provided by the configuration page on
 * the basis of their availability.
 *
 * @param string $ChoiceKey Theme ID.
 * @return bool Valid/Invalid.
 */
$phpMussel['FilterTheme'] = function ($ChoiceKey) use (&$phpMussel) {
    if ($ChoiceKey === 'default') {
        return true;
    }
    $Path = $phpMussel['Vault'] . 'fe_assets/' . $ChoiceKey . '/';
    return (file_exists($Path . 'frontend.css') || file_exists($phpMussel['Vault'] . 'template_' . $ChoiceKey . '.html'));
};

/**
 * Get the appropriate path for a specified asset as per the defined theme.
 *
 * @param string $Asset The asset filename.
 * @param bool $CanFail Is failure acceptable? (Default: False)
 * @return string The asset path.
 */
$phpMussel['GetAssetPath'] = function ($Asset, $CanFail = false) use (&$phpMussel) {
    if (
        $phpMussel['Config']['template_data']['theme'] !== 'default' &&
        file_exists($phpMussel['Vault'] . 'fe_assets/' . $phpMussel['Config']['template_data']['theme'] . '/' . $Asset)
    ) {
        return $phpMussel['Vault'] . 'fe_assets/' . $phpMussel['Config']['template_data']['theme'] . '/' . $Asset;
    }
    if (file_exists($phpMussel['Vault'] . 'fe_assets/' . $Asset)) {
        return $phpMussel['Vault'] . 'fe_assets/' . $Asset;
    }
    if ($CanFail) {
        return '';
    }
    throw new \Exception('Asset not found');
};

/**
 * Determines whether to display warnings about the PHP version used (based
 * upon what we know at the time that the package was last updated; information
 * herein is likely to become stale very quickly when not updated frequently).
 *
 * References:
 * - secure.php.net/releases/
 * - secure.php.net/supported-versions.php
 * - cvedetails.com/vendor/74/PHP.html
 * - maikuolan.github.io/Compatibility-Charts/
 * - maikuolan.github.io/Vulnerability-Charts/php.html
 *
 * @param string $Version The PHP version used (defaults to PHP_VERSION).
 * return int Warning level.
 */
$phpMussel['VersionWarning'] = function ($Version = PHP_VERSION) use (&$phpMussel) {
    $Date = date('Y.n.j', $phpMussel['Time']);
    $Level = 0;
    if (!empty($phpMussel['ForceVersionWarning']) || $phpMussel['VersionCompare']($Version, '5.6.31') || (
        !$phpMussel['VersionCompare']($Version, '7.0.0') && $phpMussel['VersionCompare']($Version, '7.0.17')
    ) || (
        !$phpMussel['VersionCompare']($Version, '7.1.0') && $phpMussel['VersionCompare']($Version, '7.1.3')
    )) {
        $Level += 2;
    }
    if ($phpMussel['VersionCompare']($Version, '7.0.0') || (
        !$phpMussel['VersionCompare']($Date, '2017.12.3') && $phpMussel['VersionCompare']($Version, '7.1.0')
    ) || (
        !$phpMussel['VersionCompare']($Date, '2018.12.1') && $phpMussel['VersionCompare']($Version, '7.2.0')
    )) {
        $Level += 1;
    }
    $phpMussel['ForceVersionWarning'] = false;
    return $Level;
};

/**
 * Executes a list of closures or commands when specific conditions are met.
 *
 * @param array|string $Closures The list of closures or commands to execute.
 */
$phpMussel['FE_Executor'] = function ($Closures) use (&$phpMussel) {
    $phpMussel['Arrayify']($Closures);
    foreach ($Closures as $Closure) {
        if (isset($phpMussel[$Closure]) && is_object($phpMussel[$Closure])) {
            $phpMussel[$Closure]();
        } elseif (($Pos = strpos($Closure, ' ')) !== false) {
            $Params = substr($Closure, $Pos + 1);
            $Closure = substr($Closure, 0, $Pos);
            if (isset($phpMussel[$Closure]) && is_object($phpMussel[$Closure])) {
                $phpMussel[$Closure]($Params);
            }
        }
    }
};

/**
 * Localises a number according to configuration specification.
 *
 * @param int $Number The number to localise.
 * @param int $Decimals Decimal places (optional).
 */
$phpMussel['Number_L10N'] = function ($Number, $Decimals = 0) use (&$phpMussel) {
    $Number = (real)$Number;
    $Sets = [
        'NoSep-1' => ['.', '', 3, false, 0],
        'NoSep-2' => [',', '', 3, false, 0],
        'Latin-1' => ['.', ',', 3, false, 0],
        'Latin-2' => ['.', ' ', 3, false, 0],
        'Latin-3' => [',', '.', 3, false, 0],
        'Latin-4' => [',', ' ', 3, false, 0],
        'Latin-5' => ['·', ',', 3, false, 0],
        'China-1' => ['.', ',', 4, false, 0],
        'India-1' => ['.', ',', 2, false, -1],
        'India-2' => ['.', ',', 2, ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'], -1],
        'Bengali-1' => ['.', ',', 2, ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], -1],
        'Arabic-1' => ['٫', '', 3, ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'], 0],
        'Arabic-2' => ['٫', '٬', 3, ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'], 0],
        'Thai-1' => ['.', ',', 3, ['๐', '๑', '๒', '๓', '๔', '๕', '๖', '๗', '๘', '๙'], 0]
    ];
    $Set = empty($Sets[$phpMussel['Config']['general']['numbers']]) ? 'Latin-1' : $Sets[$phpMussel['Config']['general']['numbers']];
    $DecPos = strpos($Number, '.') ?: strlen($Number);
    if ($Decimals && $Set[0]) {
        $Fraction = substr($Number, $DecPos + 1, $Decimals);
        $Fraction .= str_repeat('0', $Decimals - strlen($Fraction));
    }
    for ($Formatted = '', $ThouPos = $Set[4], $Pos = 1; $Pos <= $DecPos; $Pos++) {
        if ($ThouPos >= $Set[2]) {
            $ThouPos = 1;
            $Formatted = $Set[1] . $Formatted;
        } else {
            $ThouPos++;
        }
        $NegPos = $DecPos - $Pos;
        $ThisChar = substr($Number, $NegPos, 1);
        $Formatted = empty($Set[3][$ThisChar]) ? $ThisChar . $Formatted : $Set[3][$ThisChar] . $Formatted;
    }
    if ($Decimals && $Set[0]) {
        $Formatted .= $Set[0];
        for ($FracLen = strlen($Fraction), $Pos = 0; $Pos < $FracLen; $Pos++) {
            $Formatted .= empty($Set[3][$Fraction[$Pos]]) ? $Fraction[$Pos] : $Set[3][$Fraction[$Pos]];
        }
    }
    return $Formatted;
};

/**
 * Generates JavaScript code for localising numbers according to configuration
 * specification.
 */
$phpMussel['Number_L10N_JS'] = function () use (&$phpMussel) {
    $Base =
        'function l10nn(l10nd){%4$s};function nft(r){var x=r.indexOf(\'.\')!=-1?' .
        '\'%1$s\'+r.replace(/^.*\./gi,\'\'):\'\',n=r.replace(/\..*$/gi,\'\').rep' .
        'lace(/[^0-9]/gi,\'\'),t=n.length;for(e=\'\',b=%5$d,i=1;i<=t;i++){b>%3$d' .
        '&&(b=1,e=\'%2$s\'+e);var e=l10nn(n.substring(t-i,t-(i-1)))+e;b++}var t=' .
        'x.length;for(y=\'\',b=1,i=1;i<=t;i++){var y=l10nn(x.substring(t-i,t-(i-' .
        '1)))+y}return e+y}';
    $Sets = [
        'NoSep-1' => ['.', '', 3, 'return l10nd', 1],
        'NoSep-2' => [',', '', 3, 'return l10nd', 1],
        'Latin-1' => ['.', ',', 3, 'return l10nd', 1],
        'Latin-2' => ['.', ' ', 3, 'return l10nd', 1],
        'Latin-3' => [',', '.', 3, 'return l10nd', 1],
        'Latin-4' => [',', ' ', 3, 'return l10nd', 1],
        'Latin-5' => ['·', ',', 3, 'return l10nd', 1],
        'China-1' => ['.', ',', 4, 'return l10nd', 1],
        'India-1' => ['.', ',', 2, 'return l10nd', 0],
        'India-2' => ['.', ',', 2, 'var nls=[\'०\',\'१\',\'२\',\'३\',\'४\',\'५\',\'६\',\'७\',\'८\',\'९\'];return nls[l10nd]||l10nd', 0],
        'Bengali-1' => ['.', ',', 2, 'var nls=[\'০\',\'১\',\'২\',\'৩\',\'৪\',\'৫\',\'৬\',\'৭\',\'৮\',\'৯\'];return nls[l10nd]||l10nd', 0],
        'Arabic-1' => ['٫', '', 3, 'var nls=[\'٠\',\'١\',\'٢\',\'٣\',\'٤\',\'٥\',\'٦\',\'٧\',\'٨\',\'٩\'];return nls[l10nd]||l10nd', 1],
        'Arabic-2' => ['٫', '٬', 3, 'var nls=[\'٠\',\'١\',\'٢\',\'٣\',\'٤\',\'٥\',\'٦\',\'٧\',\'٨\',\'٩\'];return nls[l10nd]||l10nd', 1],
        'Thai-1' => ['.', ',', 3, 'var nls=[\'๐\',\'๑\',\'๒\',\'๓\',\'๔\',\'๕\',\'๖\',\'๗\',\'๘\',\'๙\'];return nls[l10nd]||l10nd', 1],
    ];
    if (!empty($phpMussel['Config']['general']['numbers']) && isset($Sets[$phpMussel['Config']['general']['numbers']])) {
        $Set = $Sets[$phpMussel['Config']['general']['numbers']];
        return sprintf($Base, $Set[0], $Set[1], $Set[2], $Set[3], $Set[4]);
    }
    return sprintf($Base, $Sets['Latin-1'][0], $Sets['Latin-1'][1], $Sets['Latin-1'][2], $Sets['Latin-1'][3], $Sets['Latin-1'][4]);
};

/**
 * Switch control for front-end page filters.
 *
 * @param array $Switches Names of available switches.
 * @param string $Selector Switch selector variable.
 * @param bool $StateModified Determines whether the filter state has been modified.
 * @param string $Redirect Reconstructed path to redirect to when the state changes.
 * @param string $Options Recontructed filter controls.
 */
$phpMussel['FilterSwitch'] = function($Switches, $Selector, &$StateModified, &$Redirect, &$Options) use (&$phpMussel) {
    foreach ($Switches as $Switch) {
        $State = (!empty($Selector) && $Selector === $Switch);
        $phpMussel['FE'][$Switch] = empty($phpMussel['QueryVars'][$Switch]) ? false : (
            ($phpMussel['QueryVars'][$Switch] === 'true' && !$State) ||
            ($phpMussel['QueryVars'][$Switch] !== 'true' && $State)
        );
        if ($State) {
            $StateModified = true;
        }
        if ($phpMussel['FE'][$Switch]) {
            $Redirect .= '&' . $Switch . '=true';
            $LangItem = 'switch-' . $Switch . '-set-false';
        } else {
            $Redirect .= '&' . $Switch . '=false';
            $LangItem = 'switch-' . $Switch . '-set-true';
        }
        $Label = isset($phpMussel['lang'][$LangItem]) ? $phpMussel['lang'][$LangItem] : $LangItem;
        $Options .= '<option value="' . $Switch . '">' . $Label . '</option>';
    }
};

/** Quarantine file list generator (returns an array of quarantined files). */
$phpMussel['Quarantine-RecursiveList'] = function ($DeleteMode = false) use (&$phpMussel) {
    $Arr = [];
    $Key = -1;
    $Offset = strlen($phpMussel['qfuPath']);
    $List = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($phpMussel['qfuPath']), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($List as $Item => $List) {
        /** Skips if not a quarantined file. */
        if (!preg_match('~\.qfu$~i', $Item) || is_dir($Item) || !is_file($Item) || !is_readable($Item)) {
            continue;
        }
        /** Deletes all files in quarantine. */
        if ($DeleteMode) {
            $DeleteMe = substr($Item, $Offset);
            $phpMussel['FE']['state_msg'] .= '<code>' . $DeleteMe . '</code> ' . (unlink(
                $phpMussel['qfuPath'] . $DeleteMe
            ) ? $phpMussel['lang']['response_file_deleted'] : $phpMussel['lang']['response_delete_error']) . '<br />';
            continue;
        }
        $Key++;
        $Arr[$Key] = [
            'QFU-Name' => substr($Item, $Offset),
            'QFU-JS-ID' => substr($Item, $Offset, -4),
            'QFU-Size' => filesize($Item)
        ];
        $phpMussel['FormatFilesize']($Arr[$Key]['QFU-Size']);
        $Head = $phpMussel['ReadFile']($Item, 256);
        /** Upload date/time. */
        $Arr[$Key]['Upload-Date'] = (
            ($DatePos = strpos($Head, 'Time/Date Uploaded: ')) !== false
        ) ? $phpMussel['TimeFormat'](
            (int)substr($Head, $DatePos + 20, 16),
            $phpMussel['Config']['general']['timeFormat']
        ) : $phpMussel['lang']['field_filetype_unknown'];
        /** Upload origin. */
        $Arr[$Key]['Upload-Origin'] = (
            ($OriginStartPos = strpos($Head, 'Uploaded From: ')) !== false &&
            ($OriginEndPos = strpos($Head, ' ', $OriginStartPos + 15)) !== false
        ) ? substr($Head, $OriginStartPos + 15, $OriginEndPos - $OriginStartPos - 15) : $phpMussel['lang']['field_filetype_unknown'];
        /** If the phpMussel QFU (Quarantined File Upload) header isn't found, it probably isn't a quarantined file. */
        if (($HeadPos = strpos($Head, "\xa1phpMussel\x21")) !== false && (substr($Head, $HeadPos + 31, 1) === "\x01")) {
            $Head = substr($Head, $HeadPos);
            $Arr[$Key]['Upload-MD5'] = bin2hex(substr($Head, 11, 16));
            $Arr[$Key]['Upload-Size'] = $phpMussel['UnpackSafe']('l*', substr($Head, 27, 4));
            $Arr[$Key]['Upload-Size'] = isset($Arr[$Key]['Upload-Size'][1]) ? (int)$Arr[$Key]['Upload-Size'][1] : 0;
            $phpMussel['FormatFilesize']($Arr[$Key]['Upload-Size']);
        } else {
            $Arr[$Key]['Upload-MD5'] = $phpMussel['lang']['field_filetype_unknown'];
            $Arr[$Key]['Upload-Size'] = $phpMussel['lang']['field_filetype_unknown'];
        }
        /** Appends Virus Total search URL for this hash onto the hash. */
        if (strlen($Arr[$Key]['Upload-MD5']) === 32) {
            $Arr[$Key]['Upload-MD5'] = sprintf(
                '<a href="https://www.virustotal.com/#/file/%1$s">%1$s</a>',
                $Arr[$Key]['Upload-MD5']
            );
        }
    }
    return $Arr;
};

/** Restore a quarantined file (returns the restored file data or false on failure). */
$phpMussel['Quarantine-Restore'] = function ($File, $Key) use (&$phpMussel) {
    $phpMussel['RestoreStatus'] = 1;
    if (!$File || !$Key) {
        return false;
    }
    $Data = $phpMussel['ReadFile']($File);
    /** Fetch headers. */
    if (($HeadPos = strpos($Data, "\xa1phpMussel\x21")) === false || (substr($Data, $HeadPos + 31, 1) !== "\x01")) {
        $phpMussel['RestoreStatus'] = 2;
        return false;
    }
    $Data = substr($Data, $HeadPos);
    $UploadMD5 = bin2hex(substr($Data, 11, 16));
    $UploadSize = $phpMussel['UnpackSafe']('l*', substr($Data, 27, 4));
    $UploadSize = isset($UploadSize[1]) ? (int)$UploadSize[1] : 0;
    $Data = substr($Data, 32);
    $DataLen = strlen($Data);
    if ($Key < 128) {
        $Key = $phpMussel['HexSafe'](hash('sha512', $Key) . hash('whirlpool', $Key));
    }
    $KeyLen = strlen($Key);
    $Output = '';
    $Cycle = 0;
    while ($Cycle < $DataLen) {
        for ($Inner = 0; $Inner < $KeyLen; $Inner++, $Cycle++) {
            if (strlen($Output) >= $UploadSize) {
                break 2;
            }
            $L = substr($Data, $Cycle, 1);
            $R = substr($Key, $Inner, 1);
            $Output .= ($L === false ? "\x00" : $L) ^ ($R === false ? "\x00" : $R);
        }
    }
    $Output = gzinflate($Output);
    if (empty($Output) || md5($Output) !== $UploadMD5) {
        $phpMussel['RestoreStatus'] = 3;
        return false;
    }
    $phpMussel['RestoreStatus'] = 0;
    return $Output;
};

/** Duplication avoidance (front-end updates page). */
$phpMussel['AppendTests'] = function (&$Component) use (&$phpMussel) {
    $TestData = $phpMussel['FECacheGet'](
        $phpMussel['FE']['Cache'],
        $phpMussel['Components']['RemoteMeta'][$Component['ID']]['Tests']
    );
    if (!$TestData) {
        $TestData = $phpMussel['Request'](
            $phpMussel['Components']['RemoteMeta'][$Component['ID']]['Tests']
        ) ?: '-';
        $phpMussel['FECacheAdd'](
            $phpMussel['FE']['Cache'],
            $phpMussel['FE']['Rebuild'],
            $phpMussel['Components']['RemoteMeta'][$Component['ID']]['Tests'],
            $TestData,
            $phpMussel['Time'] + 1800
        );
    }
    if (substr($TestData, 0, 1) === '{' && substr($TestData, -1) === '}') {
        $TestData = json_decode($TestData, true, 5);
    }
    if (!empty($TestData['statuses']) && is_array($TestData['statuses'])) {
        $TestsTotal = 0;
        $TestsPassed = 0;
        $TestDetails = '';
        foreach ($TestData['statuses'] as $ThisStatus) {
            $TestsTotal++;
            $StatusHead = '';
            if (
                !empty($ThisStatus['context']) &&
                !empty($ThisStatus['target_url']) &&
                !empty($ThisStatus['state'])
            ) {
                if ($ThisStatus['state'] === 'success') {
                    if ($TestsPassed !== '?') {
                        $TestsPassed++;
                    }
                    $StatusHead .= '<span class="txtGn">✔️ ';
                } elseif ($ThisStatus['state'] === 'pending') {
                    $TestsPassed = '?';
                    $StatusHead .= '<span class="txtOe">❓ ';
                } else {
                    $StatusHead .= '<span class="txtRd">❌ ';
                }
            }
            $StatusHead .= '<a href="' . $ThisStatus['target_url'] . '">';
            $phpMussel['AppendToString']($TestDetails, '<br />',
                $StatusHead . $ThisStatus['context'] . '</a></span>'
            );
        }
        if ($TestsTotal === $TestsPassed) {
            $TestClr = 'txtGn';
        } else {
            $TestClr = ($TestsPassed === '?' || $TestsPassed >= ($TestsTotal / 2)) ? 'txtOe' : 'txtRd';
        }
        $TestsTotal = sprintf(
            '<span class="%1$s">%2$s/%3$s</span> <span id="%4$s-showtests">' .
            '<input class="auto" type="button" onclick="javascript:showid(\'%4$s-tests\');hideid(\'%4$s-showtests\');showid(\'%4$s-hidetests\')" value="+" />' .
            '</span><span id="%4$s-hidetests" style="display:none">' .
            '<input class="auto" type="button" onclick="javascript:hideid(\'%4$s-tests\');showid(\'%4$s-showtests\');hideid(\'%4$s-hidetests\')" value="-" />' .
            '</span><span id="%4$s-tests" style="display:none"><br />%5$s</span>',
            $TestClr,
            ($TestsPassed === '?' ? '?' : $phpMussel['Number_L10N']($TestsPassed)),
            $phpMussel['Number_L10N']($TestsTotal),
            $Component['ID'],
            $TestDetails
        );
        $phpMussel['AppendToString']($Component['StatusOptions'], '<hr />',
            '<div class="s">' . $phpMussel['lang']['label_tests'] . ' ' . $TestsTotal
        );
    }
};

/** Traversal detection. */
$phpMussel['Traverse'] = function ($Path) {
    return !preg_match('~(?:[\./]{2}|[\x01-\x1f\[-^`?*$])~i', str_replace("\\", '/', $Path));
};

/** Sort function used by the front-end updates page. */
$phpMussel['UpdatesSortFunc'] = function ($A, $B) {
    $CheckA = preg_match('/^l10n/i', $A);
    $CheckB = preg_match('/^l10n/i', $B);
    if (($CheckA && !$CheckB) || ($A === 'phpMussel' && $B !== 'phpMussel')) {
        return -1;
    }
    if (($CheckB && !$CheckA) || ($B === 'phpMussel' && $A !== 'phpMussel')) {
        return 1;
    }
    if ($A < $B) {
        return -1;
    }
    if ($A > $B) {
        return 1;
    }
    return 0;
};
