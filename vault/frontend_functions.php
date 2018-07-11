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
 * This file: Front-end functions file (last modified: 2018.07.10).
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
            $Base = preg_replace("~\n" . preg_quote($Element) . ":?(\n [^\n]*)*\n~i", "\n", $Base);
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
    if ((substr($File, 0, 1) === '"' && substr($File, -1) === '"') || (substr($File, 0, 1) === "'" && substr($File, -1) === "'")) {
        $File = substr($File, 1, -1);
    }
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
 * Can be used to patch parts of files after updating via the front-end.
 *
 * @param string $Query The instruction to execute.
 * @return bool Success or failure.
 */
$phpMussel['In'] = function ($Query) use (&$phpMussel) {
    if (!$Delimiter = substr($Query, 0, 1)) {
        return false;
    }
    $QueryParts = explode($Delimiter, $Query);
    $CountParts = count($QueryParts);
    if ($CountParts % 2) {
        $Arr = [];
        for ($Iter = 0; $Iter < $CountParts; $Iter++) {
            if ($Iter % 2) {
                $Arr[] = $QueryParts[$Iter];
                continue;
            }
            $QueryParts[$Iter] = preg_split('~ +~', $QueryParts[$Iter], -1, PREG_SPLIT_NO_EMPTY);
            foreach ($QueryParts[$Iter] as $ThisPart) {
                $Arr[] = $ThisPart;
            }
        }
        $QueryParts = $Arr;
        unset($ThisPart, $Iter, $Arr);
    } else {
        $QueryParts = preg_split('~ +~', $Query, -1, PREG_SPLIT_NO_EMPTY);
    }

    /** Safety mechanism. */
    if (empty($QueryParts[0]) || empty($QueryParts[1]) || !file_exists($phpMussel['Vault'] . $QueryParts[0]) || !is_readable($phpMussel['Vault'] . $QueryParts[0])) {
        return false;
    }

    /** Fetch file content. */
    if (!isset($phpMussel['FE_Executor_Files'][$QueryParts[0]])) {
        $phpMussel['FE_Executor_Files'][$QueryParts[0]] = ['Old' => $phpMussel['ReadFile']($phpMussel['Vault'] . $QueryParts[0])];
        $phpMussel['FE_Executor_Files'][$QueryParts[0]]['New'] = $phpMussel['FE_Executor_Files'][$QueryParts[0]]['Old'];
    }

    /** For clean, easy referencing. */
    $Data = &$phpMussel['FE_Executor_Files'][$QueryParts[0]]['New'];

    /** Normalise main instruction. */
    $QueryParts[1] = strtolower($QueryParts[1]);

    /** Replace file content. */
    if ($QueryParts[1] === 'replace' && !empty($QueryParts[3]) && strtolower($QueryParts[3]) === 'with') {
        $Data = preg_replace($QueryParts[2], (isset($QueryParts[4]) ? $QueryParts[4] : ''), $Data);
        return true;
    }

    /** Nothing done. Return false (failure). */
    return false;
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
            preg_match('~^v?(\d+)$~i', $Ver, $Matches) ?:
            preg_match('~^v?(\d+)\.(\d+)$~i', $Ver, $Matches) ?:
            preg_match('~^v?(\d+)\.(\d+)\.(\d+)(alpha\d|RC\d{1,2}|-[.\d\w_+\\/]+)?$~i', $Ver, $Matches) ?:
            preg_match('~^(\d{1,4})[.-](\d{1,2})[.-](\d{1,4})(RC\d{1,2}|[.+-][\d\w_+\\/]+)?$~i', $Ver, $Matches) ?:
            preg_match('~^([\w]+)-([\d\w]+)-([\d\w]+)$~i', $Ver, $Matches);
        $Ver = [
            'Major' => isset($Matches[1]) ? $Matches[1] : 0,
            'Minor' => isset($Matches[2]) ? $Matches[2] : 0,
            'Patch' => isset($Matches[3]) ? $Matches[3] : 0,
            'Build' => isset($Matches[4]) ? $Matches[4] : 0
        ];
        if ($Ver['Build'] && substr($Ver['Build'], 0, 1) === '-') {
            $Ver['Build'] = substr($Ver['Build'], 1);
        }
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
                } elseif ($phpMussel['FileManager-IsLogFile']($ThisNameFixed)) {
                    $Component = $phpMussel['lang']['link_logs'];
                } else {
                    $LastFour = strtolower(substr($ThisNameFixed, -4));
                    if (
                        $LastFour === '.tmp' ||
                        $ThisNameFixed === 'index.dat' ||
                        $ThisNameFixed === 'fe_assets/frontend.dat' ||
                        substr($ThisNameFixed, -9) === '.rollback'
                    ) {
                        $Component = $phpMussel['lang']['label_fmgr_cache_data'];
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
        preg_match('~(?://|[^!\d\w\._-]$)~i', $Path) ||
        preg_match('~^(?:/\.\.|./\.|\.{3})$~', str_replace("\\", '/', substr($Path, -3)))
    ) {
        return false;
    }
    $Path = preg_split('@/@', $Path, -1, PREG_SPLIT_NO_EMPTY);
    $Valid = true;
    array_walk($Path, function ($Segment) use (&$Valid) {
        if (empty($Segment) || preg_match('/(?:[\x00-\x1f\x7f]+|^\.+$)/i', $Segment)) {
            $Valid = false;
        }
    });
    return $Valid;
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
        $ThisName = str_replace("\\", '/', substr($Item, strlen($Base)));
        if (!is_file($Item) || !is_readable($Item) || is_dir($Item) || !$phpMussel['FileManager-IsLogFile']($ThisName)) {
            continue;
        }
        $Arr[$ThisName] = ['Filename' => $ThisName, 'Filesize' => filesize($Item)];
        $phpMussel['FormatFilesize']($Arr[$ThisName]['Filesize']);
    }
    ksort($Arr);
    return $Arr;
};

/** Checks whether a component is in use (front-end closure). */
$phpMussel['IsInUse'] = function (&$Component) use (&$phpMussel) {
    $Files = empty($Component['Files']['To']) ? [] : $Component['Files']['To'];
    foreach ($Files as $File) {
        if (substr($File, 0, 11) === 'signatures/' && preg_match(
            '~,(?:[\w\d]+:)?' . preg_quote(substr($File, 11)) . ',~',
            ',' . $phpMussel['Config']['signatures']['Active'] . ','
        )) {
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

/** Check whether component is activable. */
$phpMussel['IsActivable'] = function (&$Component) {
    return (!empty($Component['Files']['To'][0]) && substr($Component['Files']['To'][0], 0, 11) === 'signatures/');
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
    if (!empty($phpMussel['Components']['Meta'][$phpMussel['Targets']]['Files'])) {
        $phpMussel['Arrayify']($phpMussel['Components']['Meta'][$phpMussel['Targets']]['Files']);
        $phpMussel['Arrayify']($phpMussel['Components']['Meta'][$phpMussel['Targets']]['Files']['To']);
        return $phpMussel['IsInUse']($phpMussel['Components']['Meta'][$phpMussel['Targets']]);
    }
    return false;
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
    $Minor = substr($Version, 0, 4);
    if (!empty($phpMussel['ForceVersionWarning']) || $phpMussel['VersionCompare']($Version, '5.6.36') || substr($Version, 0, 2) === '6.' || (
        $Minor === '7.0.' && $phpMussel['VersionCompare']($Version, '7.0.30')
    ) || (
        $Minor === '7.1.' && $phpMussel['VersionCompare']($Version, '7.1.17')
    ) || (
        $Minor === '7.2.' && $phpMussel['VersionCompare']($Version, '7.2.7')
    )) {
        $Level += 2;
    }
    if ($phpMussel['VersionCompare']($Version, '7.1.0') || (
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
    $phpMussel['FE_Executor_Files'] = [];
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
    foreach ($phpMussel['FE_Executor_Files'] as $Name => $Data) {
        if (isset($Data['New']) && isset($Data['Old']) && $Data['New'] !== $Data['Old'] && file_exists($phpMussel['Vault'] . $Name) && is_writable($phpMussel['Vault'] . $Name)) {
            $Handle = fopen($phpMussel['Vault'] . $Name, 'w');
            fwrite($Handle, $Data['New']);
            fclose($Handle);
        }
    }
    unset($phpMussel['FE_Executor_Files']);
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
$phpMussel['FilterSwitch'] = function ($Switches, $Selector, &$StateModified, &$Redirect, &$Options) use (&$phpMussel) {
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
$phpMussel['AppendTests'] = function (&$Component, $ReturnState = false) use (&$phpMussel) {
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
            if (empty($ThisStatus['context']) || empty($ThisStatus['state'])) {
                continue;
            }
            $TestsTotal++;
            $StatusHead = '';
            if ($ThisStatus['state'] === 'success') {
                if ($TestsPassed !== '?') {
                    $TestsPassed++;
                }
                $StatusHead .= '<span class="txtGn">✔️ ';
            } elseif ($ThisStatus['state'] === 'pending') {
                $TestsPassed = '?';
                $StatusHead .= '<span class="txtOe">❓ ';
            } else {
                if ($ReturnState) {
                    return false;
                }
                $StatusHead .= '<span class="txtRd">❌ ';
            }
            $StatusHead .= empty($ThisStatus['target_url']) ? $ThisStatus['context'] : (
                '<a href="' . $ThisStatus['target_url'] . '">' . $ThisStatus['context'] . '</a>'
            );
            if (!$ReturnState) {
                $phpMussel['AppendToString']($TestDetails, '<br />', $StatusHead . '</span>');
            }
        }
        if (!$ReturnState) {
            if ($TestsTotal === $TestsPassed) {
                $TestClr = 'txtGn';
            } else {
                $TestClr = ($TestsPassed === '?' || $TestsPassed >= ($TestsTotal / 2)) ? 'txtOe' : 'txtRd';
            }
            $TestsTotal = sprintf(
                '<span class="%1$s">%2$s/%3$s</span><br /><span id="%4$s-showtests">' .
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
            $phpMussel['AppendToString'](
                $Component['StatusOptions'],
                '<hr />',
                '<div class="s">' . $phpMussel['lang']['label_tests'] . ' ' . $TestsTotal
            );
        }
    }
    if ($ReturnState) {
        return true;
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

/** Updates handler. */
$phpMussel['UpdatesHandler'] = function ($Action, $ID) use (&$phpMussel) {

    /** Define component targets. */
    $phpMussel['Targets'] = $ID;

    /** Update a component. */
    if ($Action === 'update-component') {
        return $phpMussel['UpdatesHandler-Update']($ID);
    }

    /** Uninstall a component. */
    if ($Action === 'uninstall-component') {
        return $phpMussel['UpdatesHandler-Uninstall']($ID);
    }

    /** Activate a component. */
    if ($Action === 'activate-component') {
        return $phpMussel['UpdatesHandler-Activate']($ID);
    }

    /** Deactivate a component. */
    if ($Action === 'deactivate-component') {
        return $phpMussel['UpdatesHandler-Deactivate']($ID);
    }

    /** Verify a component. */
    if ($Action === 'verify-component') {
        return $phpMussel['UpdatesHandler-Verify']($ID);
    }

};

/** Updates handler: Update a component. */
$phpMussel['UpdatesHandler-Update'] = function ($ID) use (&$phpMussel) {
    $phpMussel['Arrayify']($ID);
    $FileData = [];
    $Annotations = [];
    foreach ($ID as $phpMussel['Components']['ThisTarget']) {
        if (!isset(
            $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Remote'],
            $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Reannotate']
        )) {
            continue;
        }
        $phpMussel['Components']['BytesAdded'] = 0;
        $phpMussel['Components']['BytesRemoved'] = 0;
        $phpMussel['Components']['TimeRequired'] = microtime(true);
        $phpMussel['Components']['RemoteMeta'] = [];
        $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'] = $phpMussel['FECacheGet'](
            $phpMussel['FE']['Cache'],
            $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Remote']
        );
        if (!$phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData']) {
            $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'] = $phpMussel['Request'](
                $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Remote']
            );
            if (
                strtolower(substr($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Remote'], -2)) === 'gz' &&
                substr($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'], 0, 2) === "\x1f\x8b"
            ) {
                $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'] = gzdecode(
                    $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData']
                );
            }
            if (empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'])) {
                $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'] = '-';
            }
            $phpMussel['FECacheAdd'](
                $phpMussel['FE']['Cache'],
                $phpMussel['FE']['Rebuild'],
                $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Remote'],
                $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'],
                $phpMussel['Time'] + 3600
            );
        }
        $phpMussel['UpdateFailed'] = false;
        if (
            substr($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'], 0, 4) === "---\n" &&
            ($phpMussel['Components']['EoYAML'] = strpos(
                $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'], "\n\n"
            )) !== false &&
            $phpMussel['YAML'](
                substr($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'], 4, $phpMussel['Components']['EoYAML'] - 4),
                $phpMussel['Components']['RemoteMeta']
            ) &&
            !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Minimum Required']) &&
            !$phpMussel['VersionCompare'](
                $phpMussel['ScriptVersion'],
                $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Minimum Required']
            ) &&
            (
                empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Minimum Required PHP']) ||
                !$phpMussel['VersionCompare'](PHP_VERSION, $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Minimum Required PHP'])
            ) &&
            !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From']) &&
            !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To']) &&
            !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Reannotate']) &&
            $phpMussel['Traverse']($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Reannotate']) &&
            ($ThisReannotate = $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Reannotate']) &&
            file_exists($phpMussel['Vault'] . $ThisReannotate) &&
            ((
                !empty($FileData[$ThisReannotate]) &&
                $phpMussel['Components']['OldMeta'] = $FileData[$ThisReannotate]
            ) || (
                $FileData[$ThisReannotate] = $phpMussel['Components']['OldMeta'] = $phpMussel['ReadFile'](
                    $phpMussel['Vault'] . $ThisReannotate
                )
            )) &&
            preg_match(
                "\x01(\n" . preg_quote($phpMussel['Components']['ThisTarget']) . ":?)(\n [^\n]*)*\n\x01i",
                $phpMussel['Components']['OldMeta'],
                $phpMussel['Components']['OldMetaMatches']
            ) &&
            ($phpMussel['Components']['OldMetaMatches'] = $phpMussel['Components']['OldMetaMatches'][0]) &&
            ($phpMussel['Components']['NewMeta'] = $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData']) &&
            preg_match(
                "\x01(\n" . preg_quote($phpMussel['Components']['ThisTarget']) . ":?)(\n [^\n]*)*\n\x01i",
                $phpMussel['Components']['NewMeta'],
                $phpMussel['Components']['NewMetaMatches']
            ) &&
            ($phpMussel['Components']['NewMetaMatches'] = $phpMussel['Components']['NewMetaMatches'][0]) &&
            (!$phpMussel['FE']['CronMode'] || empty(
                $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Tests']
            ) || $phpMussel['AppendTests']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']], true))
        ) {
            $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']);
            $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From']);
            $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To']);
            if (!empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'])) {
                $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum']);
            }
            $phpMussel['Components']['NewMeta'] = str_replace(
                $phpMussel['Components']['OldMetaMatches'],
                $phpMussel['Components']['NewMetaMatches'],
                $phpMussel['Components']['OldMeta']
            );
            $Count = count($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From']);
            $phpMussel['RemoteFiles'] = [];
            $phpMussel['IgnoredFiles'] = [];
            $Rollback = false;
            /** Write new and updated files and directories. */
            for ($Iterate = 0; $Iterate < $Count; $Iterate++) {
                if (empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To'][$Iterate])) {
                    continue;
                }
                $ThisFileName = $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To'][$Iterate];
                /** Rolls back to previous version or uninstalls if an update/install fails. */
                if ($Rollback) {
                    if (
                        isset($phpMussel['RemoteFiles'][$ThisFileName]) &&
                        !isset($phpMussel['IgnoredFiles'][$ThisFileName]) &&
                        is_readable($phpMussel['Vault'] . $ThisFileName)
                    ) {
                        $phpMussel['Components']['BytesAdded'] -= filesize($phpMussel['Vault'] . $ThisFileName);
                        unlink($phpMussel['Vault'] . $ThisFileName);
                        if (is_readable($phpMussel['Vault'] . $ThisFileName . '.rollback')) {
                            $phpMussel['Components']['BytesRemoved'] -= filesize($phpMussel['Vault'] . $ThisFileName . '.rollback');
                            rename($phpMussel['Vault'] . $ThisFileName . '.rollback', $phpMussel['Vault'] . $ThisFileName);
                        }
                    }
                    continue;
                }
                if (
                    !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$Iterate]) &&
                    !empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$Iterate]) && (
                        $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$Iterate] ===
                        $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$Iterate]
                    )
                ) {
                    $phpMussel['IgnoredFiles'][$ThisFileName] = true;
                    continue;
                }
                if (
                    empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From'][$Iterate]) ||
                    !($ThisFile = $phpMussel['Request'](
                        $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From'][$Iterate]
                    ))
                ) {
                    $Iterate = 0;
                    $Rollback = true;
                    continue;
                }
                if (
                    strtolower(substr(
                        $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From'][$Iterate], -2
                    )) === 'gz' &&
                    strtolower(substr($ThisFileName, -2)) !== 'gz' &&
                    substr($ThisFile, 0, 2) === "\x1f\x8b"
                ) {
                    $ThisFile = gzdecode($ThisFile);
                }
                if (!empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$Iterate])) {
                    $ThisChecksum = $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$Iterate];
                    $ThisLen = strlen($ThisFile);
                    if (
                        (md5($ThisFile) . ':' . $ThisLen) !== $ThisChecksum &&
                        (sha1($ThisFile) . ':' . $ThisLen) !== $ThisChecksum &&
                        (hash('sha256', $ThisFile) . ':' . $ThisLen) !== $ThisChecksum
                    ) {
                        $phpMussel['FE']['state_msg'] .=
                            '<code>' . $phpMussel['Components']['ThisTarget'] . '</code> – ' .
                            '<code>' . $ThisFileName . '</code> – ' .
                            $phpMussel['lang']['response_checksum_error'] . '<br />';
                        if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['On Checksum Error'])) {
                            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['On Checksum Error']);
                        }
                        $Iterate = 0;
                        $Rollback = true;
                        continue;
                    }
                }
                if (
                    preg_match('~\.(?:css|dat|gif|inc|jpe?g|php|png|ya?ml|[a-z]{0,2}db)$~i', $ThisFileName) &&
                    !$phpMussel['CheckFileUpdate']($ThisFile)
                ) {
                    $phpMussel['FE']['state_msg'] .=
                        '<code>' . $phpMussel['Components']['ThisTarget'] . '</code> – ' .
                        '<code>' . $ThisFileName . '</code> – ' .
                        $phpMussel['lang']['response_sanity_1'] . '<br />';
                    if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['On Sanity Error'])) {
                        $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['On Sanity Error']);
                    }
                    $Iterate = 0;
                    $Rollback = true;
                    continue;
                }
                $ThisName = $ThisFileName;
                $ThisPath = $phpMussel['Vault'];
                while (strpos($ThisName, '/') !== false || strpos($ThisName, "\\") !== false) {
                    $phpMussel['Separator'] = (strpos($ThisName, '/') !== false) ? '/' : "\\";
                    $phpMussel['ThisDir'] = substr($ThisName, 0, strpos($ThisName, $phpMussel['Separator']));
                    $ThisPath .= $phpMussel['ThisDir'] . '/';
                    $ThisName = substr($ThisName, strlen($phpMussel['ThisDir']) + 1);
                    if (!file_exists($ThisPath) || !is_dir($ThisPath)) {
                        mkdir($ThisPath);
                    }
                }
                if (is_readable($phpMussel['Vault'] . $ThisFileName)) {
                    $phpMussel['Components']['BytesRemoved'] += filesize($phpMussel['Vault'] . $ThisFileName);
                    if (file_exists($phpMussel['Vault'] . $ThisFileName . '.rollback')) {
                        unlink($phpMussel['Vault'] . $ThisFileName . '.rollback');
                    }
                    rename($phpMussel['Vault'] . $ThisFileName, $phpMussel['Vault'] . $ThisFileName . '.rollback');
                }
                $phpMussel['Components']['BytesAdded'] += strlen($ThisFile);
                $Handle = fopen($phpMussel['Vault'] . $ThisFileName, 'w');
                $phpMussel['RemoteFiles'][$ThisFileName] = fwrite($Handle, $ThisFile);
                $phpMussel['RemoteFiles'][$ThisFileName] = ($phpMussel['RemoteFiles'][$ThisFileName] !== false);
                fclose($Handle);
                $ThisFile = '';
            }
            if ($Rollback) {
                /** Prune unwanted empty directories (update/install failure+rollback). */
                if (
                    !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To']) &&
                    is_array($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To'])
                ) {
                    array_walk($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To'], function ($ThisFile) use (&$phpMussel) {
                        if (!empty($ThisFile) && $phpMussel['Traverse']($ThisFile)) {
                            $phpMussel['DeleteDirectory']($ThisFile);
                        }
                    });
                }
                $phpMussel['UpdateFailed'] = true;
            } else {
                /** Prune unwanted files and directories (update/install success). */
                if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files']['To'])) {
                    $ThisArr = $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files']['To'];
                    $phpMussel['Arrayify']($ThisArr);
                    array_walk($ThisArr, function ($ThisFile) use (&$phpMussel) {
                        if (!empty($ThisFile) && $phpMussel['Traverse']($ThisFile)) {
                            if (file_exists($phpMussel['Vault'] . $ThisFile . '.rollback')) {
                                unlink($phpMussel['Vault'] . $ThisFile . '.rollback');
                            }
                            if (
                                !isset($phpMussel['RemoteFiles'][$ThisFile]) &&
                                !isset($phpMussel['IgnoredFiles'][$ThisFile]) &&
                                file_exists($phpMussel['Vault'] . $ThisFile)
                            ) {
                                $phpMussel['Components']['BytesRemoved'] += filesize($phpMussel['Vault'] . $ThisFile);
                                unlink($phpMussel['Vault'] . $ThisFile);
                                $phpMussel['DeleteDirectory']($ThisFile);
                            }
                        }
                    });
                    unset($ThisArr);
                }
                /** Assign updated component annotation. */
                $FileData[$ThisReannotate] = $phpMussel['Components']['NewMeta'];
                if (!isset($Annotations[$ThisReannotate])) {
                    $Annotations[$ThisReannotate] = $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'];
                }
                $phpMussel['FE']['state_msg'] .= '<code>' . $phpMussel['Components']['ThisTarget'] . '</code> – ';
                if (
                    empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Version']) &&
                    empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files'])
                ) {
                    $phpMussel['FE']['state_msg'] .= $phpMussel['lang']['response_component_successfully_installed'];
                    if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Install Succeeds'])) {
                        $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Install Succeeds']);
                    }
                } else {
                    $phpMussel['FE']['state_msg'] .= $phpMussel['lang']['response_component_successfully_updated'];
                    if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Update Succeeds'])) {
                        $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Update Succeeds']);
                    }
                }
                $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']] =
                    $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']];
            }
        } else {
            $phpMussel['UpdateFailed'] = true;
        }
        if ($phpMussel['UpdateFailed']) {
            $phpMussel['FE']['state_msg'] .= '<code>' . $phpMussel['Components']['ThisTarget'] . '</code> – ';
            if (
                empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Version']) &&
                empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files'])
            ) {
                $phpMussel['FE']['state_msg'] .= $phpMussel['lang']['response_failed_to_install'];
                if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Install Fails'])) {
                    $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Install Fails']);
                }
            } else {
                $phpMussel['FE']['state_msg'] .= $phpMussel['lang']['response_failed_to_update'];
                if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Update Fails'])) {
                    $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Update Fails']);
                }
            }
        }
        $phpMussel['FormatFilesize']($phpMussel['Components']['BytesAdded']);
        $phpMussel['FormatFilesize']($phpMussel['Components']['BytesRemoved']);
        $phpMussel['FE']['state_msg'] .= sprintf(
            $phpMussel['FE']['CronMode'] ? " « +%s | -%s | %s »\n" : ' <code><span class="txtGn">+%s</span> | <span class="txtRd">-%s</span> | <span class="txtOe">%s</span></code><br />',
            $phpMussel['Components']['BytesAdded'],
            $phpMussel['Components']['BytesRemoved'],
            $phpMussel['Number_L10N'](microtime(true) - $phpMussel['Components']['TimeRequired'], 3)
        );
    }
    /** Update annotations. */
    foreach ($FileData as $ThisKey => $ThisFile) {
        /** Remove superfluous metadata. */
        if (!empty($Annotations[$ThisKey])) {
            $ThisFile = $phpMussel['Congruency']($ThisFile, $Annotations[$ThisKey]);
        }
        $Handle = fopen($phpMussel['Vault'] . $ThisKey, 'w');
        fwrite($Handle, $ThisFile);
        fclose($Handle);
    }
    /** Cleanup. */
    unset($phpMussel['RemoteFiles'], $phpMussel['IgnoredFiles']);
};

/** Updates handler: Uninstall a component. */
$phpMussel['UpdatesHandler-Uninstall'] = function ($ID) use (&$phpMussel) {
    $InUse = $phpMussel['ComponentFunctionUpdatePrep']();
    $phpMussel['Components']['BytesRemoved'] = 0;
    $phpMussel['Components']['TimeRequired'] = microtime(true);
    if (
        empty($InUse) &&
        !empty($phpMussel['Components']['Meta'][$ID]['Files']['To']) &&
        ($ID !== 'l10n/' . $phpMussel['Config']['general']['lang']) &&
        ($ID !== 'theme/' . $phpMussel['Config']['template_data']['theme']) &&
        ($ID !== 'phpMussel') &&
        !empty($phpMussel['Components']['Meta'][$ID]['Reannotate']) &&
        !empty($phpMussel['Components']['Meta'][$ID]['Uninstallable']) &&
        ($phpMussel['Components']['OldMeta'] = $phpMussel['ReadFile'](
            $phpMussel['Vault'] . $phpMussel['Components']['Meta'][$ID]['Reannotate']
        )) &&
        preg_match(
            "\x01(\n" . preg_quote($ID) . ":?)(\n [^\n]*)*\n\x01i",
            $phpMussel['Components']['OldMeta'],
            $phpMussel['Components']['OldMetaMatches']
        ) &&
        ($phpMussel['Components']['OldMetaMatches'] = $phpMussel['Components']['OldMetaMatches'][0])
    ) {
        $phpMussel['Components']['NewMeta'] = str_replace(
            $phpMussel['Components']['OldMetaMatches'],
            preg_replace(
                ["/\n Files:(\n  [^\n]*)*\n/i", "/\n Version: [^\n]*\n/i"],
                "\n",
                $phpMussel['Components']['OldMetaMatches']
            ),
            $phpMussel['Components']['OldMeta']
        );
        array_walk($phpMussel['Components']['Meta'][$ID]['Files']['To'], function ($ThisFile) use (&$phpMussel) {
            if (!empty($ThisFile) && $phpMussel['Traverse']($ThisFile)) {
                if (file_exists($phpMussel['Vault'] . $ThisFile)) {
                    $phpMussel['Components']['BytesRemoved'] += filesize($phpMussel['Vault'] . $ThisFile);
                    unlink($phpMussel['Vault'] . $ThisFile);
                }
                if (file_exists($phpMussel['Vault'] . $ThisFile . '.rollback')) {
                    $phpMussel['Components']['BytesRemoved'] += filesize($phpMussel['Vault'] . $ThisFile . '.rollback');
                    unlink($phpMussel['Vault'] . $ThisFile . '.rollback');
                }
                $phpMussel['DeleteDirectory']($ThisFile);
            }
        });
        $Handle = fopen($phpMussel['Vault'] . $phpMussel['Components']['Meta'][$ID]['Reannotate'], 'w');
        fwrite($Handle, $phpMussel['Components']['NewMeta']);
        fclose($Handle);
        $phpMussel['Components']['Meta'][$ID]['Version'] = false;
        $phpMussel['Components']['Meta'][$ID]['Files'] = false;
        $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_component_successfully_uninstalled'];
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Uninstall Succeeds'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Uninstall Succeeds']);
        }
    } else {
        $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_component_uninstall_error'];
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Uninstall Fails'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Uninstall Fails']);
        }
    }
    $phpMussel['FormatFilesize']($phpMussel['Components']['BytesRemoved']);
    $phpMussel['FE']['state_msg'] .= sprintf(
        $phpMussel['FE']['CronMode'] ? " « -%s | %s »\n" : ' <code><span class="txtRd">-%s</span> | <span class="txtOe">%s</span></code>',
        $phpMussel['Components']['BytesRemoved'],
        $phpMussel['Number_L10N'](microtime(true) - $phpMussel['Components']['TimeRequired'], 3)
    );
};

/** Updates handler: Activate a component. */
$phpMussel['UpdatesHandler-Activate'] = function ($ID) use (&$phpMussel) {
    $phpMussel['Activation'] = [
        'Config' => $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['FE']['ActiveConfigFile']),
        'Active' => $phpMussel['Config']['signatures']['Active'],
        'Modified' => false
    ];
    $InUse = $phpMussel['ComponentFunctionUpdatePrep']();
    if (empty($InUse) && !empty($phpMussel['Components']['Meta'][$ID]['Files']['To'])) {
        $phpMussel['Activation']['Active'] = array_unique(array_filter(
            explode(',', $phpMussel['Activation']['Active']),
            function ($Component) use (&$phpMussel) {
                $Component = (strpos($Component, ':') === false) ? $Component : substr($Component, strpos($Component, ':') + 1);
                return ($Component && file_exists($phpMussel['sigPath'] . $Component));
            }
        ));
        foreach ($phpMussel['Components']['Meta'][$ID]['Files']['To'] as $phpMussel['Activation']['ThisFile']) {
            if (
                !empty($phpMussel['Activation']['ThisFile']) &&
                file_exists($phpMussel['Vault'] . $phpMussel['Activation']['ThisFile']) &&
                substr($phpMussel['Activation']['ThisFile'], 0, 11) === 'signatures/' &&
                $phpMussel['Traverse']($phpMussel['Activation']['ThisFile'])
            ) {
                $phpMussel['Activation']['Active'][] = substr($phpMussel['Activation']['ThisFile'], 11);
            }
        }
        if (count($phpMussel['Activation']['Active'])) {
            sort($phpMussel['Activation']['Active']);
        }
        $phpMussel['Activation']['Active'] = implode(',', $phpMussel['Activation']['Active']);
        if ($phpMussel['Activation']['Active'] !== $phpMussel['Config']['signatures']['Active']) {
            $phpMussel['Activation']['Modified'] = true;
        }
    }
    if (!$phpMussel['Activation']['Modified'] || !$phpMussel['Activation']['Config']) {
        $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_activation_failed'];
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Activation Fails'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Activation Fails']);
        }
    } else {
        $EOL = (strpos($phpMussel['Activation']['Config'], "\r\nActive=") !== false) ? "\r\n" : "\n";
        $phpMussel['Activation']['Config'] = str_replace(
            $EOL . "Active='" . $phpMussel['Config']['signatures']['Active'] . "'" . $EOL,
            $EOL . "Active='" . $phpMussel['Activation']['Active'] . "'" . $EOL,
            $phpMussel['Activation']['Config']
        );
        $phpMussel['Config']['signatures']['Active'] = $phpMussel['Activation']['Active'];
        $Handle = fopen($phpMussel['Vault'] . $phpMussel['FE']['ActiveConfigFile'], 'w');
        fwrite($Handle, $phpMussel['Activation']['Config']);
        fclose($Handle);
        $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_activated'];
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Activation Succeeds'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Activation Succeeds']);
        }
    }
    /** Cleanup. */
    unset($phpMussel['Activation']);
};

/** Updates handler: Deactivate a component. */
$phpMussel['UpdatesHandler-Deactivate'] = function ($ID) use (&$phpMussel) {
    $phpMussel['Deactivation'] = [
        'Config' => $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['FE']['ActiveConfigFile']),
        'Active' => $phpMussel['Config']['signatures']['Active'],
        'Modified' => false
    ];
    $InUse = $phpMussel['ComponentFunctionUpdatePrep']();
    if (!empty($InUse) && !empty($phpMussel['Components']['Meta'][$ID]['Files']['To'])) {
        $phpMussel['Deactivation']['Active'] = array_unique(array_filter(
            explode(',', $phpMussel['Deactivation']['Active']),
            function ($Component) use (&$phpMussel) {
                $Component = (strpos($Component, ':') === false) ? $Component : substr($Component, strpos($Component, ':') + 1);
                return ($Component && file_exists($phpMussel['sigPath'] . $Component));
            }
        ));
        if (count($phpMussel['Deactivation']['Active'])) {
            sort($phpMussel['Deactivation']['Active']);
        }
        $phpMussel['Deactivation']['Active'] = ',' . implode(',', $phpMussel['Deactivation']['Active']) . ',';
        foreach ($phpMussel['Components']['Meta'][$ID]['Files']['To'] as $phpMussel['Deactivation']['ThisFile']) {
            if (substr($phpMussel['Deactivation']['ThisFile'], 0, 11) === 'signatures/') {
                $phpMussel['Deactivation']['Active'] = preg_replace(
                    '~,(?:[\w\d]+:)?' . preg_quote(substr($phpMussel['Deactivation']['ThisFile'], 11)) . ',~',
                    ',',
                    $phpMussel['Deactivation']['Active']
                );
            }
        }
        $phpMussel['Deactivation']['Active'] = substr($phpMussel['Deactivation']['Active'], 1, -1);
        if ($phpMussel['Deactivation']['Active'] !== $phpMussel['Config']['signatures']['Active']) {
            $phpMussel['Deactivation']['Modified'] = true;
        }
    }
    if (!$phpMussel['Deactivation']['Modified'] || !$phpMussel['Deactivation']['Config']) {
        $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_deactivation_failed'];
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Deactivation Fails'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Deactivation Fails']);
        }
    } else {
        $EOL = (strpos($phpMussel['Deactivation']['Config'], "\r\nActive=") !== false) ? "\r\n" : "\n";
        $phpMussel['Deactivation']['Config'] = str_replace(
            $EOL . "Active='" . $phpMussel['Config']['signatures']['Active'] . "'" . $EOL,
            $EOL . "Active='" . $phpMussel['Deactivation']['Active'] . "'" . $EOL,
            $phpMussel['Deactivation']['Config']
        );
        $phpMussel['Config']['signatures']['Active'] = $phpMussel['Deactivation']['Active'];
        $Handle = fopen($phpMussel['Vault'] . $phpMussel['FE']['ActiveConfigFile'], 'w');
        fwrite($Handle, $phpMussel['Deactivation']['Config']);
        fclose($Handle);
        $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_deactivated'];
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Deactivation Succeeds'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Deactivation Succeeds']);
        }
    }
    /** Cleanup. */
    unset($phpMussel['Deactivation']);
};

/** Updates handler: Verify a component. */
$phpMussel['UpdatesHandler-Verify'] = function ($ID) use (&$phpMussel) {
    $phpMussel['Arrayify']($ID);
    foreach ($ID as $ThisID) {
        $Ident = strtolower(preg_replace('~[^\da-z]~i', '', $ThisID));
        $HideLinkClass = 'hl_' . $Ident;
        $ShowLinkClass = 'sl_' . $Ident;
        $Ident = 'v_' . $Ident;
        $Table = sprintf(
            '<span class="v %1$s" style="display:none"><table><tr><td class="h4"><div class="s">%2$s</div></td><td class="h2"><div class="s">%3$s</div></td><td class="h2f"><div class="s">%4$s</div></td></tr>',
            $Ident,
            $phpMussel['lang']['field_file'],
            $phpMussel['lang']['label_actual'],
            $phpMussel['lang']['label_expected']
        );
        if (!empty($phpMussel['Components']['Meta'][$ThisID]['Files'])) {
            $TheseFiles = $phpMussel['Components']['Meta'][$ThisID]['Files'];
        }
        if (!empty($TheseFiles['To'])) {
            $phpMussel['Arrayify']($TheseFiles['To']);
        }
        $Count = count($TheseFiles['To']);
        if (!empty($TheseFiles['Checksum'])) {
            $phpMussel['Arrayify']($TheseFiles['Checksum']);
        }
        $Passed = true;
        for ($Iterate = 0; $Iterate < $Count; $Iterate++) {
            $ThisFile = $TheseFiles['To'][$Iterate];
            $FileFailMsg = '<code>' . $ThisID . '</code> – <code>' . $ThisFile . '</code> – ' . $phpMussel['lang']['response_possible_problem_found'] . '<br />';
            $Checksum = empty($TheseFiles['Checksum'][$Iterate]) ? false : $TheseFiles['Checksum'][$Iterate];
            $Class = 's';
            if (!$ThisFileData = $phpMussel['ReadFile']($phpMussel['Vault'] . $ThisFile)) {
                $phpMussel['FE']['state_msg'] .= $FileFailMsg;
                $Passed = false;
                $Actual = '';
            } else {
                $Len = strlen($ThisFileData);
                $HashPartLen = strpos($Checksum, ':') ?: 64;
                if ($HashPartLen === 32) {
                    $Actual = md5($ThisFileData) . ':' . $Len;
                } else {
                    $Actual = (($HashPartLen === 40) ? sha1($ThisFileData) : hash('sha256', $ThisFileData)) . ':' . $Len;
                }
                if (($Checksum && $Actual !== $Checksum && ($Class = 'txtRd')) || (
                    preg_match('~\.(?:css|dat|gif|inc|jpe?g|php|png|ya?ml|[a-z]{0,2}db)$~i', $ThisFile) &&
                    !$phpMussel['CheckFileUpdate']($ThisFileData)
                )) {
                    $phpMussel['FE']['state_msg'] .= $FileFailMsg;
                    $Passed = false;
                }
                if ($Checksum && $Class !== 'txtRd') {
                    $Class = 'txtGn';
                }
            }
            $Table .= sprintf(
                '<tr><td class="h3"><code class="s">%1$s</code></td><td class="h1"><code class="%2$s">%3$s</code></td><td class="h1f"><code class="%2$s">%4$s</code></td></tr>',
                $ThisFile,
                $Class,
                $Actual,
                $Checksum
            );
        }
        $Table .= '</table></span>';
        $phpMussel['FE']['state_msg'] .= '<code>' . $ThisID . '</code> – ' . (
            $Passed ? $phpMussel['lang']['response_verification_success'] : $phpMussel['lang']['response_verification_failed']
        ) . sprintf(
            ' %1$ssl_ %3$s%2$shide(\'v\');%10$sshow%5$shide(\'%3$s\');show(\'%4$s\');%6$s%7$s%8$s%1$shl_ %4$s%2$shide(\'v\');%10$s" style="display:none;%6$s%9$s%8$s',
            '<a class="',
            '" href="javascript:void(0);" onclick="javascript:',
            $ShowLinkClass,
            $HideLinkClass,
            "('" . $Ident . "');",
            '"><code>[',
            $phpMussel['lang']['label_show_hash_table'],
            ']</code></a>',
            $phpMussel['lang']['label_hide_hash_table'],
            'hide(\'hl_\');show(\'sl_\');'
        ) . '<br />' . $Table;
    }
};

/** Normalise linebreaks. */
$phpMussel['NormaliseLinebreaks'] = function (&$Data) {
    if (strpos($Data, "\r")) {
        $Data = (strpos($Data, "\r\n") !== false) ? str_replace("\r", '', $Data) : str_replace("\r", "\n", $Data);
    }
};

/** Signature information handler. */
$phpMussel['SigInfoHandler'] = function ($Active) use (&$phpMussel) {

    /** Check whether shorthand data has been fetched. If it hasn't, fetch it. */
    if (!isset($phpMussel['shorthand.yaml'])) {
        if (!file_exists($phpMussel['Vault'] . 'shorthand.yaml') || !is_readable($phpMussel['Vault'] . 'shorthand.yaml')) {
            return '<span class="s">' . $phpMussel['lang']['response_error'] . '</span>';
        }
        $phpMussel['shorthand.yaml'] = [];
        $phpMussel['YAML']($phpMussel['ReadFile']($phpMussel['Vault'] . 'shorthand.yaml'), $phpMussel['shorthand.yaml']);
    }

    /** Get list of vendor search patterns and metadata search pattern partials. */
    $Arr = [
        'Vendors' => $phpMussel['shorthand.yaml']['Vendor Search Patterns'],
        'SigTypes' => $phpMussel['shorthand.yaml']['Metadata Search Pattern Partials']
    ];

    /** Expand patterns for signature metadata. */
    foreach ($Arr['SigTypes'] as &$Type) {
        $Type = sprintf(
            '\x1a(?![\x80-\x8f])[\x0%1$s\x1%1$s\x2%1$s\x3%1$s\x4%1$s\x5%1$s\x6%1$s\x7%1$s\x8%1$s\x9%1$s\xa%1$s\xb%1$s\xc%1$s\xd%1$s\xe%1$s\ef%1$s]',
            $Type
        );
    }

    /** Get list of vector search patterns. */
    $Arr['Targets'] = $phpMussel['shorthand.yaml']['Vector Search Patterns'];

    /** Get list of malware type search patterns. */
    $Arr['MalwareTypes'] = $phpMussel['shorthand.yaml']['Malware Type Search Patterns'];

    /** To be populated by totals. */
    $Totals = ['Classes' => [], 'Files' => [], 'Vendors' => [], 'SigTypes' => [], 'Targets' => [], 'MalwareTypes' => []];

    /** Signature file classes. */
    $Classes = [
        ['General_Command_Detections', ''],
        ['Filename', '\n(?!>)'],
        ['Hash', '\n[\dA-Fa-f]{32,}:\d+:'],
        ['Standard', '\n(?!>)'],
        ['Standard_RegEx', '\n(?!>)'],
        ['Normalised', '\n(?!>)'],
        ['Normalised_RegEx', '\n(?!>)'],
        ['HTML', '\n(?!>)'],
        ['HTML_RegEx', '\n(?!>)'],
        ['PE_Extended', '\n\$PE\w+:[\dA-Fa-f]{32,}:\d+:'],
        ['PE_Sectional', '\n\d+:[\dA-Fa-f]{32,}:'],
        ['Complex_Extended', '\n\$\S+;'],
        ['URL_Scanner', '\n(?:TLD|(?:DOMAIN|URL)(?:-NOLOOKUP)?|QUERY)\S+:']
    ];

    /** We cycle through this several times in this closure. */
    $Subs = ['Classes', 'Files', 'Vendors', 'SigTypes', 'Targets', 'MalwareTypes'];

    /** Iterate through active signature files and append totals. */
    foreach ($Active as $File) {
        $File = (strpos($File, ':') === false) ? $File : substr($File, strpos($File, ':') + 1);
        $Data = $File && is_readable($phpMussel['sigPath'] . $File) ? $phpMussel['ReadFile']($phpMussel['sigPath'] . $File) : '';
        if (substr($Data, 0, 9) !== 'phpMussel') {
            continue;
        }
        $Class = substr($Data, 9, 1);
        $Nibbles = $phpMussel['split_nibble']($Class);
        $Class = !isset($Classes[$Nibbles[0]]) ? '?' : $Classes[$Nibbles[0]];
        $Totals['Files'][$File] = empty($Class[1]) ? substr_count($Data, ',') + 1 : preg_match_all('/' . $Class[1] . '\S+/', $Data);
        if (!empty($Class[0])) {
            $Totals['Classes'][$Class[0]] = isset($Totals['Classes'][$Class[0]]) ? $Totals['Classes'][$Class[0]] + $Totals['Files'][$File] : $Totals['Files'][$File];
        }
        foreach ($Subs as $Sub) {
            $Totals[$Sub]['Total'] = isset($Totals[$Sub]['Total']) ? $Totals[$Sub]['Total'] + $Totals['Files'][$File] : $Totals['Files'][$File];
        }
        $phpMussel['NormaliseLinebreaks']($Data);
        if (!empty($Class[1])) {
            foreach (['Vendors', 'SigTypes', 'Targets', 'MalwareTypes'] as $Sub) {
                foreach ($Arr[$Sub] as $Key => $Pattern) {
                    $Counts = preg_match_all('/' . $Class[1] . $Pattern . '\S+/', $Data);
                    $Totals[$Sub][$Key] = isset($Totals[$Sub][$Key]) ? $Totals[$Sub][$Key] + $Counts : $Counts;
                }
            }
        }
    }

    /** Build "other" totals. */
    foreach ($Subs as $Sub) {
        $Other = isset($Totals[$Sub]['Total']) ? $Totals[$Sub]['Total'] : 0;
        foreach ($Totals[$Sub] as $Key => $SubTotal) {
            if ($Key === 'Total') {
                continue;
            }
            $Other -= $SubTotal;
        }
        $Totals[$Sub]['Other'] = $Other;
    }

    /** Cleanup. */
    unset($SubTotal, $Other, $Data, $File, $Counts, $Arr);

    /** To be populated by category menus. */
    $phpMussel['FE']['infoCatOptions'] = '';

    /** To be populated by output tables. */
    $Out = '';

    /** Process totals. */
    foreach ($Subs as $Sub) {
        $Label = isset($phpMussel['lang']['siginfo_sub_' . $Sub]) ? $phpMussel['lang']['siginfo_sub_' . $Sub] : $Sub;
        $Class = 'sigtype_' . strtolower($Sub);
        $phpMussel['FE']['infoCatOptions'] .= "\n            <option value=\"" . $Class . '">' . $Label . '</option>';
        $ThisTable = '<span style="display:none" class="' . $Class . '"><table><tr><td class="center h4f" colspan="2"><span class="s">' . $Label . '</span></td></tr>' . "\n";
        arsort($Totals[$Sub]);
        foreach ($Totals[$Sub] as $Key => &$Total) {
            if (!$Total) {
                continue;
            }
            $Total = $phpMussel['Number_L10N']($Total);
            if ($Key === 'Other' && $Sub === 'SigTypes') {
                $Label = isset($phpMussel['lang']['siginfo_key_Other_Metadata']) ? $phpMussel['lang']['siginfo_key_Other_Metadata'] : '';
            } else {
                $Label = isset($phpMussel['lang']['siginfo_key_' . $Key]) ? $phpMussel['lang']['siginfo_key_' . $Key] : '';
            }
            if ($Key !== 'Total' && $Key !== 'Other') {
                if (!$Label) {
                    $Label = sprintf($phpMussel['lang']['siginfo_xkey'], $Key);
                }
                $CellClass = 'h3';
            } else {
                $CellClass = 'r';
            }
            $ThisTable .= $phpMussel['ParseVars'](['x' => $CellClass, 'InfoType' => $Label, 'InfoNum' => $Total], $phpMussel['FE']['InfoRow']);
        }
        $Out .= $ThisTable . '</table></span>' . "\n";
    }

    /** Return totals and exit closure. */
    return $Out;
};

/** Assign some basic variables (initial prepwork for most front-end pages). */
$phpMussel['InitialPrepwork'] = function ($Title = '', $Tips = '', $JS = true) use (&$phpMussel) {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $Title;

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = empty(
        $phpMussel['FE']['UserRaw']
    ) ? $Tips : $phpMussel['ParseVars'](['username' => $phpMussel['FE']['UserRaw']], $Tips);

    /** Load main front-end JavaScript data. */
    $phpMussel['FE']['JS'] = $JS ? $phpMussel['ReadFile']($phpMussel['GetAssetPath']('scripts.js')) : '';

};

/** Send page output for front-end pages (plus some other final prepwork). */
$phpMussel['SendOutput'] = function () use (&$phpMussel) {
    if ($phpMussel['FE']['JS']) {
        $phpMussel['FE']['JS'] = "\n<script type=\"text/javascript\">" . $phpMussel['FE']['JS'] . '</script>';
    }
    return $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);
};

/**
 * Confirm whether a file is a logfile (used by the file manager and logs viewer).
 *
 * @param string $File The path/name of the file to be confirmed.
 * @return bool True if it's a logfile; False if it isn't.
 */
$phpMussel['FileManager-IsLogFile'] = function ($File) use (&$phpMussel) {
    static $Pattern_scan_log = false;
    if (!$Pattern_scan_log && $phpMussel['Config']['general']['scan_log']) {
        $Pattern_scan_log = $phpMussel['BuildLogPattern']($phpMussel['Config']['general']['scan_log'], true);
    }
    static $Pattern_scan_log_serialized = false;
    if (!$Pattern_scan_log_serialized && $phpMussel['Config']['general']['scan_log_serialized']) {
        $Pattern_scan_log_serialized = $phpMussel['BuildLogPattern']($phpMussel['Config']['general']['scan_log_serialized'], true);
    }
    static $Pattern_scan_kills = false;
    if (!$Pattern_scan_kills && $phpMussel['Config']['general']['scan_kills']) {
        $Pattern_scan_kills = $phpMussel['BuildLogPattern']($phpMussel['Config']['general']['scan_kills'], true);
    }
    static $Pattern_FrontEndLog = false;
    if (!$Pattern_FrontEndLog && $phpMussel['Config']['general']['FrontEndLog']) {
        $Pattern_FrontEndLog = $phpMussel['BuildLogPattern']($phpMussel['Config']['general']['FrontEndLog'], true);
    }
    return preg_match('~\.log(?:\.gz)?$~', strtolower($File)) || (
        $phpMussel['Config']['general']['scan_log'] && preg_match($Pattern_scan_log, $File)
    ) || (
        $phpMussel['Config']['general']['scan_log_serialized'] && preg_match($Pattern_scan_log_serialized, $File)
    ) || (
        $phpMussel['Config']['general']['scan_kills'] && preg_match($Pattern_scan_kills, $File)
    ) || (
        $phpMussel['Config']['general']['FrontEndLog'] && preg_match($Pattern_FrontEndLog, $File)
    );
};

/**
 * Generates JavaScript snippets for confirmation prompts for front-end actions.
 *
 * @param string $Action The action being taken to be confirmed.
 * @param string $Form The ID of the form to be submitted when the action is confirmed.
 * @return string The JavaScript snippet.
 */
$phpMussel['GenerateConfirm'] = function ($Action, $Form) use (&$phpMussel) {
    $Confirm = str_replace(["'", '"'], ["\'", '\x22'], sprintf($phpMussel['lang']['confirm_action'], $Action));
    return 'javascript:confirm(\'' . $Confirm . '\')&&document.getElementById(\'' . $Form . '\').submit()';
};

/**
 * Checks file updates for known sanity errors (upstream problems, wrong files served because of server downtime, etc).
 *
 * @param string $FileData The data of the file to check.
 * @param int $Mode What to check for (to be determined by the calling code).
 * @return bool File passes check (true) or fails check (false).
 */
$phpMussel['CheckFileUpdate'] = function ($FileData, $Mode = 1) use (&$phpMussel) {
    if ($Mode === 1) {
        return $FileData && !preg_match('~<(?:html|body)~i', $FileData);
    }
    return true;
};
