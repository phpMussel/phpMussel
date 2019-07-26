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
 * This file: Front-end functions file (last modified: 2019.07.24).
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
    $BaseArr = (new \Maikuolan\Common\YAML($Base))->Data;
    $ModelArr = (new \Maikuolan\Common\YAML($Model))->Data;
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
    if (preg_match('~^(\'.*\'|".*")$~', $File)) {
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
    if (!($CountParts % 2)) {
        return false;
    }
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
    unset($ThisPart, $Iter, $Arr, $CountParts);

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

/**
 * Format filesize information.
 *
 * @param int $Filesize
 */
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
    $Filesize = $phpMussel['NumberFormatter']->format($Filesize, ($Iterate === 0) ? 0 : 2) . ' ' . $phpMussel['L10N']->getPlural($Filesize, $Scale[$Iterate]);
};

/**
 * Remove an entry from the front-end cache data.
 *
 * @param string $Source Variable containing cache file data.
 * @param bool $Rebuild Flag indicating to rebuild cache file.
 * @param string $Entry Name of the cache entry to be deleted.
 */
$phpMussel['FECacheRemove'] = function (&$Source, &$Rebuild, $Entry) use (&$phpMussel) {

    /** Override if using a different preferred caching mechanism. */
    if (isset($phpMussel['Cache']) && $phpMussel['Cache']->Using) {
        $phpMussel['Cache']->deleteEntry($Entry);
        return;
    }

    /** Default process. */
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

    /** Override if using a different preferred caching mechanism. */
    if (isset($phpMussel['Cache']) && $phpMussel['Cache']->Using) {
        $phpMussel['Cache']->setEntry($Entry, $Data, $Expires - $phpMussel['Time']);
        return;
    }

    /** Default process. */
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
 * @param string $Entry Name of the cache entry to get.
 * @return string|bool Returned cache entry data (or false on failure).
 */
$phpMussel['FECacheGet'] = function (&$Source, $Entry) use (&$phpMussel) {

    /** Override if using a different preferred caching mechanism. */
    if (isset($phpMussel['Cache']) && $phpMussel['Cache']->Using) {
        return $phpMussel['Cache']->getEntry($Entry);
    }

    /** Default process. */
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
 * @return bool True if the 2nd version is newer than the 1st version, and false
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
 * @return array An array.
 */
$phpMussel['ArrayFlatten'] = function (array $Arr) {
    return array_filter($Arr, function () {
        return (!is_array(func_get_args()[0]));
    });
};

/**
 * Reduce an L10N array down to a single relevant string.
 *
 * @param array $Arr An L10N array.
 * @param string $Lang The language that we're hoping to isolate from the array.
 */
$phpMussel['IsolateL10N'] = function (array &$Arr, $Lang) {
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
 * Performs some simple sanity checks on files (used by the updater).
 *
 * @param string $FileName The name of the file to be checked.
 * @param string $FileData The content of the file to be checked.
 * @return bool True when passed; False when failed.
 */
$phpMussel['SanityCheck'] = function ($FileName, $FileData) {

    /** Check whether YAML is valid. */
    if (preg_match('~\.ya?ml$~i', $FileName)) {
        $ThisYAML = new \Maikuolan\Common\YAML();
        if (!($ThisYAML->process($FileData, $ThisYAML->Data))) {
            return false;
        }
    }

    /** A very simple, rudimentary check for unwanted, possibly maliciously inserted HTML. */
    if ($FileData && preg_match('~<(?:html|body)~i', $FileData)) {
        return false;
    }

    /** Passed. */
    return true;
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
            $Arr[$Key]['Filetype'] = $phpMussel['L10N']->getString('field_filetype_directory');
            $Arr[$Key]['Icon'] = 'icon=directory';
        } elseif (is_file($Item)) {
            $Arr[$Key]['CanEdit'] = true;
            $Arr[$Key]['Directory'] = false;
            $Arr[$Key]['Filesize'] = filesize($Item);
            if (isset($phpMussel['FE']['TotalSize'])) {
                $phpMussel['FE']['TotalSize'] += $Arr[$Key]['Filesize'];
            }
            if (isset($phpMussel['Components']['Components'])) {
                $Component = $phpMussel['L10N']->getString('field_filetype_unknown');
                $ThisNameFixed = str_replace("\\", '/', $ThisName);
                if (isset($phpMussel['Components']['Files'][$ThisNameFixed])) {
                    if (!empty($phpMussel['Components']['Names'][$phpMussel['Components']['Files'][$ThisNameFixed]])) {
                        $Component = $phpMussel['Components']['Names'][$phpMussel['Components']['Files'][$ThisNameFixed]];
                    } else {
                        $Component = $phpMussel['Components']['Files'][$ThisNameFixed];
                    }
                    if ($Component === 'phpMussel') {
                        $Component .= ' (' . $phpMussel['L10N']->getString('field_component') . ')';
                    }
                } elseif (preg_match('~(?:[^|/]\.ht|\.safety$|^salt\.dat$)~i', $ThisNameFixed)) {
                    $Component = $phpMussel['L10N']->getString('label_fmgr_safety');
                } elseif (preg_match('/^config\.ini$/i', $ThisNameFixed)) {
                    $Component = $phpMussel['L10N']->getString('link_config');
                } elseif ($phpMussel['FileManager-IsLogFile']($ThisNameFixed)) {
                    $Component = $phpMussel['L10N']->getString('link_logs');
                } elseif (preg_match('~^(?:greylist\.csv|signatures/.*\.(?:csv|db))$~i', $ThisNameFixed)) {
                    $Component = $phpMussel['L10N']->getString('label_fmgr_other_sig');
                } elseif (preg_match('~(?:\.tmp|\.rollback|^(?:cache/index|fe_assets/frontend)\.dat)$~i', $ThisNameFixed)) {
                    $Component = $phpMussel['L10N']->getString('label_fmgr_cache_data');
                } elseif (preg_match('/\.qfu$/i', $ThisNameFixed)) {
                    $Component = $phpMussel['L10N']->getString('label_quarantined');
                } elseif (preg_match('/\.(?:dat|ya?ml)$/i', $ThisNameFixed)) {
                    $Component = $phpMussel['L10N']->getString('label_fmgr_updates_metadata');
                }
                if (!isset($phpMussel['Components']['Components'][$Component])) {
                    $phpMussel['Components']['Components'][$Component] = 0;
                }
                $phpMussel['Components']['Components'][$Component] += $Arr[$Key]['Filesize'];
                if (!isset($phpMussel['Components']['ComponentFiles'][$Component])) {
                    $phpMussel['Components']['ComponentFiles'][$Component] = [];
                }
                $phpMussel['Components']['ComponentFiles'][$Component][$ThisNameFixed] = $Arr[$Key]['Filesize'];
            }
            if (($ExtDel = strrpos($Item, '.')) !== false) {
                $Ext = strtoupper(substr($Item, $ExtDel + 1));
                if (!$Ext) {
                    $Arr[$Key]['Filetype'] = $phpMussel['L10N']->getString('field_filetype_unknown');
                    $Arr[$Key]['Icon'] = 'icon=unknown';
                    $phpMussel['FormatFilesize']($Arr[$Key]['Filesize']);
                    continue;
                }
                $Arr[$Key]['Filetype'] = $phpMussel['ParseVars'](['EXT' => $Ext], $phpMussel['L10N']->getString('field_filetype_info'));
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
                $Arr[$Key]['Filetype'] = $phpMussel['L10N']->getString('field_filetype_unknown');
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
$phpMussel['FetchComponentsLists'] = function ($Base, array &$Arr) use (&$phpMussel) {
    $Files = new DirectoryIterator($Base);
    foreach ($Files as $ThisFile) {
        if (!empty($ThisFile) && preg_match('/\.(?:dat|inc|ya?ml)$/i', $ThisFile)) {
            $Data = $phpMussel['ReadFile']($Base . $ThisFile);
            if (substr($Data, 0, 4) === "---\n" && ($EoYAML = strpos($Data, "\n\n")) !== false) {
                $phpMussel['YAML']->process(substr($Data, 4, $EoYAML - 4), $Arr);
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

/**
 * Checks whether a component is in use (front-end closure).
 *
 * @param array $Component An array of the component metadata.
 * @return bool True for when in use; False for when not in use.
 */
$phpMussel['IsInUse'] = function (array &$Component) use (&$phpMussel) {
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
    $phpMussel['Components']['ThisComponent']['RemoteData'] = '';
    $phpMussel['FetchRemote-ContextFree'](
        $phpMussel['Components']['ThisComponent']['RemoteData'],
        $phpMussel['Components']['ThisComponent']['Remote']
    );
};

/**
 * Fetch remote data (context-free).
 *
 * @param string $RemoteData Where to put the remote data.
 * @param string $Remote Where to get the remote data.
 */
$phpMussel['FetchRemote-ContextFree'] = function (&$RemoteData, &$Remote) use (&$phpMussel) {
    $RemoteData = $phpMussel['FECacheGet']($phpMussel['FE']['Cache'], $Remote);
    if (!$RemoteData) {
        $RemoteData = $phpMussel['Request']($Remote);
        if (strtolower(substr($Remote, -2)) === 'gz' && substr($RemoteData, 0, 2) === "\x1f\x8b") {
            $RemoteData = gzdecode($RemoteData);
        }
        if (empty($RemoteData)) {
            $RemoteData = '-';
        }
        $phpMussel['FECacheAdd'](
            $phpMussel['FE']['Cache'],
            $phpMussel['FE']['Rebuild'],
            $Remote,
            $RemoteData,
            $phpMussel['Time'] + 3600
        );
    }
};

/**
 * Checks whether component is activable.
 *
 * @param array $Component An array of the component metadata.
 * @return bool True for when activable; False for when not activable.
 */
$phpMussel['IsActivable'] = function (array &$Component) {
    return (!empty($Component['Files']['To'][0]) && substr($Component['Files']['To'][0], 0, 11) === 'signatures/');
};

/**
 * Prepares component extended description (front-end updates page).
 *
 * @param array $Arr Metadata of the component to be prepared.
 * @param string $Key A key to use to help find L10N data for the component description.
 */
$phpMussel['PrepareExtendedDescription'] = function (array &$Arr, $Key = '') use (&$phpMussel) {
    $Key = 'Extended Description ' . $Key;
    if (isset($phpMussel['lang'][$Key])) {
        $Arr['Extended Description'] = $phpMussel['L10N']->getString($Key);
    } elseif (empty($Arr['Extended Description'])) {
        $Arr['Extended Description'] = '';
    }
    if (is_array($Arr['Extended Description'])) {
        $phpMussel['IsolateL10N']($Arr['Extended Description'], $phpMussel['Config']['general']['lang']);
    }
};

/**
 * Prepares component name (front-end updates page).
 *
 * @param array $Arr Metadata of the component to be prepared.
 * @param string $Key A key to use to help find L10N data for the component name.
 */
$phpMussel['PrepareName'] = function (array &$Arr, $Key = '') use (&$phpMussel) {
    $Key = 'Name ' . $Key;
    if (isset($phpMussel['lang'][$Key])) {
        $Arr['Name'] = $phpMussel['L10N']->getString($Key);
    } elseif (empty($Arr['Name'])) {
        $Arr['Name'] = '';
    }
    if (is_array($Arr['Name'])) {
        $phpMussel['IsolateL10N']($Arr['Name'], $phpMussel['Config']['general']['lang']);
    }
};

/**
 * Duplication avoidance (front-end updates page).
 *
 * @param string $Targets
 * @return bool Always false.
 */
$phpMussel['ComponentFunctionUpdatePrep'] = function ($Targets) use (&$phpMussel) {
    if (!empty($phpMussel['Components']['Meta'][$Targets]['Files'])) {
        $phpMussel['Arrayify']($phpMussel['Components']['Meta'][$Targets]['Files']);
        $phpMussel['Arrayify']($phpMussel['Components']['Meta'][$Targets]['Files']['To']);
        return $phpMussel['IsInUse']($phpMussel['Components']['Meta'][$Targets]);
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
    return (file_exists($Path . '.yaml') && file_exists($Path . '.fe.yaml'));
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
 * @throws Exception if the asset can't be found.
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
 * @return int Warning level.
 */
$phpMussel['VersionWarning'] = function ($Version = PHP_VERSION) use (&$phpMussel) {
    $Level = 0;
    $Minor = (float)$Version;
    if (!empty($phpMussel['ForceVersionWarning']) || $Minor < 7.1 || (
        $Minor === 7.1 && $phpMussel['VersionCompare']($Version, '7.1.30')
    ) || (
        $Minor === 7.2 && $phpMussel['VersionCompare']($Version, '7.2.19')
    ) || (
        $Minor === 7.3 && $phpMussel['VersionCompare']($Version, '7.3.6')
    )) {
        $Level += 2;
    }
    if ($Minor < 7.2) {
        $Level += 1;
    }
    $phpMussel['ForceVersionWarning'] = false;
    return $Level;
};

/**
 * Executes a list of closures or commands when specific conditions are met.
 *
 * @param string|array $Closures The list of closures or commands to execute.
 * @param bool $Queue Whether to queue the operation or perform immediately.
 */
$phpMussel['FE_Executor'] = function ($Closures = false, $Queue = false) use (&$phpMussel) {
    if ($Queue && $Closures !== false) {
        if (empty($phpMussel['FE_Executor_Queue'])) {
            $phpMussel['FE_Executor_Queue'] = [];
        }
        $phpMussel['FE_Executor_Queue'][] = $Closures;
        return;
    }
    if ($Closures === false && !empty($phpMussel['FE_Executor_Queue'])) {
        foreach ($phpMussel['FE_Executor_Queue'] as $QueueItem) {
            $phpMussel['FE_Executor']($QueueItem);
        }
        $phpMussel['FE_Executor_Queue'] = [];
        return;
    }
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
        if (isset($Data['New']) && isset($Data['Old']) && $Data['New'] !== $Data['Old'] && is_file($phpMussel['Vault'] . $Name) && is_writable($phpMussel['Vault'] . $Name)) {
            $Handle = fopen($phpMussel['Vault'] . $Name, 'w');
            fwrite($Handle, $Data['New']);
            fclose($Handle);
        }
    }
    unset($phpMussel['FE_Executor_Files']);
};

/** Used to format numbers according to the specified configuration. */
$phpMussel['NumberFormatter'] = new \Maikuolan\Common\NumberFormatter($phpMussel['Config']['general']['numbers']);

/** Used by the Number_L10N_JS closure (separated out to improve memory footprint). */
$phpMussel['Number_L10N_JS_Sets'] = [
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
    'India-3' => ['.', ',', 2, 'var nls=[\'૦\',\'૧\',\'૨\',\'૩\',\'૪\',\'૫\',\'૬\',\'૭\',\'૮\',\'૯\'];return nls[l10nd]||l10nd', 0],
    'India-4' => ['.', ',', 2, 'var nls=[\'੦\',\'੧\',\'੨\',\'੩\',\'੪\',\'੫\',\'੬\',\'੭\',\'੮\',\'੯\'];return nls[l10nd]||l10nd', 0],
    'India-5' => ['.', ',', 2, 'var nls=[\'೦\',\'೧\',\'೨\',\'೩\',\'೪\',\'೫\',\'೬\',\'೭\',\'೮\',\'೯\'];return nls[l10nd]||l10nd', 0],
    'India-6' => ['.', ',', 2, 'var nls=[\'౦\',\'౧\',\'౨\',\'౩\',\'౪\',\'౫\',\'౬\',\'౭\',\'౮\',\'౯\'];return nls[l10nd]||l10nd', 0],
    'Arabic-1' => ['٫', '', 3, 'var nls=[\'٠\',\'١\',\'٢\',\'٣\',\'٤\',\'٥\',\'٦\',\'٧\',\'٨\',\'٩\'];return nls[l10nd]||l10nd', 1],
    'Arabic-2' => ['٫', '٬', 3, 'var nls=[\'٠\',\'١\',\'٢\',\'٣\',\'٤\',\'٥\',\'٦\',\'٧\',\'٨\',\'٩\'];return nls[l10nd]||l10nd', 1],
    'Arabic-3' => ['٫', '٬', 3, 'var nls=[\'۰\',\'۱\',\'۲\',\'۳\',\'۴\',\'۵\',\'۶\',\'۷\',\'۸\',\'۹\'];return nls[l10nd]||l10nd', 1],
    'Arabic-4' => ['٫', '٬', 2, 'var nls=[\'۰\',\'۱\',\'۲\',\'۳\',\'۴\',\'۵\',\'۶\',\'۷\',\'۸\',\'۹\'];return nls[l10nd]||l10nd', 0],
    'Bengali-1' => ['.', ',', 2, 'var nls=[\'০\',\'১\',\'২\',\'৩\',\'৪\',\'৫\',\'৬\',\'৭\',\'৮\',\'৯\'];return nls[l10nd]||l10nd', 0],
    'Burmese-1' => ['.', '', 3, 'var nls=[\'၀\',\'၁\',\'၂\',\'၃\',\'၄\',\'၅\',\'၆\',\'၇\',\'၈\',\'၉\'];return nls[l10nd]||l10nd', 1],
    'Khmer-1' => [',', '.', 3, 'var nls=[\'០\',\'១\',\'២\',\'៣\',\'៤\',\'៥\',\'៦\',\'៧\',\'៨\',\'៩\'];return nls[l10nd]||l10nd', 1],
    'Lao-1' => ['.', '', 3, 'var nls=[\'໐\',\'໑\',\'໒\',\'໓\',\'໔\',\'໕\',\'໖\',\'໗\',\'໘\',\'໙\'];return nls[l10nd]||l10nd', 1],
    'Thai-1' => ['.', ',', 3, 'var nls=[\'๐\',\'๑\',\'๒\',\'๓\',\'๔\',\'๕\',\'๖\',\'๗\',\'๘\',\'๙\'];return nls[l10nd]||l10nd', 1],
    'Thai-2' => ['.', '', 3, 'var nls=[\'๐\',\'๑\',\'๒\',\'๓\',\'๔\',\'๕\',\'๖\',\'๗\',\'๘\',\'๙\'];return nls[l10nd]||l10nd', 1],
];

/**
 * Generates JavaScript code for localising numbers locally.
 *
 * @return string The JavaScript code.
 */
$phpMussel['Number_L10N_JS'] = function () use (&$phpMussel) {
    $Base =
        'function l10nn(l10nd){%4$s};function nft(r){var x=r.indexOf(\'.\')!=-1?' .
        '\'%1$s\'+r.replace(/^.*\./gi,\'\'):\'\',n=r.replace(/\..*$/gi,\'\').rep' .
        'lace(/[^0-9]/gi,\'\'),t=n.length;for(e=\'\',b=%5$d,i=1;i<=t;i++){b>%3$d' .
        '&&(b=1,e=\'%2$s\'+e);var e=l10nn(n.substring(t-i,t-(i-1)))+e;b++}var t=' .
        'x.length;for(y=\'\',b=1,i=1;i<=t;i++){var y=l10nn(x.substring(t-i,t-(i-' .
        '1)))+y}return e+y}';
    if (
        !empty($phpMussel['Config']['general']['numbers']) &&
        isset($phpMussel['Number_L10N_JS_Sets'][$phpMussel['Config']['general']['numbers']])
    ) {
        $Set = $phpMussel['Number_L10N_JS_Sets'][$phpMussel['Config']['general']['numbers']];
    } else {
        $Set = $phpMussel['Number_L10N_JS_Sets']['Latin-1'];
    }
    return sprintf($Base, $Set[0], $Set[1], $Set[2], $Set[3], $Set[4]);
};

/**
 * Switch control for front-end page filters.
 *
 * @param array $Switches Names of available switches.
 * @param string $Selector Switch selector variable.
 * @param bool $StateModified Determines whether the filter state has been modified.
 * @param string $Redirect Reconstructed path to redirect to when the state changes.
 * @param string $Options Reconstructed filter controls.
 */
$phpMussel['FilterSwitch'] = function (array $Switches, $Selector, &$StateModified, &$Redirect, &$Options) use (&$phpMussel) {
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
        $Label = $phpMussel['L10N']->getString($LangItem) ?: $LangItem;
        $Options .= '<option value="' . $Switch . '">' . $Label . '</option>';
    }
};

/**
 * Quarantined file list generator (returns an array of quarantined files).
 *
 * @param bool $DeleteMode Whether to delete quarantined files when checking.
 * @return array An array of quarantined files.
 */
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
            $phpMussel['FE']['state_msg'] .= '<code>' . $DeleteMe . '</code> ' . $phpMussel['L10N']->getString(
                unlink($phpMussel['qfuPath'] . $DeleteMe) ? 'response_file_deleted' : 'response_delete_error'
            ) . '<br />';
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
        ) : $phpMussel['L10N']->getString('field_filetype_unknown');
        /** Upload origin. */
        $Arr[$Key]['Upload-Origin'] = (
            ($OriginStartPos = strpos($Head, 'Uploaded From: ')) !== false &&
            ($OriginEndPos = strpos($Head, ' ', $OriginStartPos + 15)) !== false
        ) ? substr($Head, $OriginStartPos + 15, $OriginEndPos - $OriginStartPos - 15) : $phpMussel['L10N']->getString('field_filetype_unknown');
        /** If the phpMussel QFU (Quarantined File Upload) header isn't found, it probably isn't a quarantined file. */
        if (($HeadPos = strpos($Head, "\xa1phpMussel\x21")) !== false && (substr($Head, $HeadPos + 31, 1) === "\x01")) {
            $Head = substr($Head, $HeadPos);
            $Arr[$Key]['Upload-MD5'] = bin2hex(substr($Head, 11, 16));
            $Arr[$Key]['Upload-Size'] = $phpMussel['UnpackSafe']('l*', substr($Head, 27, 4));
            $Arr[$Key]['Upload-Size'] = isset($Arr[$Key]['Upload-Size'][1]) ? (int)$Arr[$Key]['Upload-Size'][1] : 0;
            $phpMussel['FormatFilesize']($Arr[$Key]['Upload-Size']);
        } else {
            $Arr[$Key]['Upload-MD5'] = $phpMussel['L10N']->getString('field_filetype_unknown');
            $Arr[$Key]['Upload-Size'] = $phpMussel['L10N']->getString('field_filetype_unknown');
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

/**
 * Restore a quarantined file (returns the restored file data or false on failure).
 *
 * @param string $File Path to the file to be restored.
 * @param string $Key The quarantine key used to quarantine the file.
 * @return string|bool The content of the restored file, or false on failure.
 */
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

/**
 * Appends test data onto component metadata.
 *
 * @param array $Component The component to append test data onto.
 * @param bool $ReturnState Whether to operate as a function or a procedure.
 * @return bool|null Indicates whether tests have passed, when operating as a function.
 */
$phpMussel['AppendTests'] = function (array &$Component, $ReturnState = false) use (&$phpMussel) {
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
                ($TestsPassed === '?' ? '?' : $phpMussel['NumberFormatter']->format($TestsPassed)),
                $phpMussel['NumberFormatter']->format($TestsTotal),
                $Component['ID'],
                $TestDetails
            );
            $phpMussel['AppendToString'](
                $Component['StatusOptions'],
                '<hr />',
                '<div class="s">' . $phpMussel['L10N']->getString('label_tests') . ' ' . $TestsTotal
            );
        }
    }
    if ($ReturnState) {
        return true;
    }
};

/**
 * Traversal detection.
 *
 * @param string $Path The path to check for traversal.
 * @return bool True when the path is traversal-free. False when traversal has been detected.
 */
$phpMussel['Traverse'] = function ($Path) {
    return !preg_match('~(?:[\./]{2}|[\x01-\x1f\[-^`?*$])~i', str_replace("\\", '/', $Path));
};

/**
 * Sort function used by the front-end updates page.
 *
 * @param string $A
 * @param string $B
 */
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

/**
 * Updates handler.
 *
 * @param string $Action The action to take (update/install, verify, uninstall, activate, deactivate).
 * @return string|array The ID(/s) of the component(/s) to perform the specified action upon.
 */
$phpMussel['UpdatesHandler'] = function ($Action, $ID = '') use (&$phpMussel) {

    /** Support for executor calls. */
    if ($ID === '' && ($Pos = strpos($Action, ' ')) !== false) {
        $ID = substr($Action, $Pos + 1);
        $Action = substr($Action, 0, $Pos);
        if (strpos($ID, ',') !== false) {
            $ID = explode(',', $ID);
        }
    }

    /** Update a component. */
    if ($Action === 'update-component') {
        $phpMussel['UpdatesHandler-Update']($ID);
    }

    /** Verify a component. */
    if ($Action === 'verify-component') {
        $phpMussel['UpdatesHandler-Verify']($ID);
    }

    /** Uninstall a component. */
    if (!is_array($ID) && $Action === 'uninstall-component') {
        $phpMussel['UpdatesHandler-Uninstall']($ID);
    }

    /** Activate a component. */
    if (!is_array($ID) && $Action === 'activate-component') {
        $phpMussel['UpdatesHandler-Activate']($ID);
    }

    /** Deactivate a component. */
    if (!is_array($ID) && $Action === 'deactivate-component') {
        $phpMussel['UpdatesHandler-Deactivate']($ID);
    }

    /** Process and empty executor queue. */
    $phpMussel['FE_Executor']();

};

/**
 * Updates handler: Update a component.
 *
 * @param string|array $ID The ID (or array of IDs) of the component(/s) to update.
 */
$phpMussel['UpdatesHandler-Update'] = function ($ID) use (&$phpMussel) {
    $phpMussel['Arrayify']($ID);
    $FileData = [];
    $Annotations = [];
    foreach ($ID as $ThisTarget) {
        if (!isset(
            $phpMussel['Components']['Meta'][$ThisTarget]['Remote'],
            $phpMussel['Components']['Meta'][$ThisTarget]['Reannotate']
        )) {
            continue;
        }
        $phpMussel['Components']['BytesAdded'] = 0;
        $phpMussel['Components']['BytesRemoved'] = 0;
        $phpMussel['Components']['TimeRequired'] = microtime(true);
        $phpMussel['Components']['RemoteMeta'] = [];
        $phpMussel['Components']['Meta'][$ThisTarget]['RemoteData'] = '';
        $phpMussel['FetchRemote-ContextFree'](
            $phpMussel['Components']['Meta'][$ThisTarget]['RemoteData'],
            $phpMussel['Components']['Meta'][$ThisTarget]['Remote']
        );
        $phpMussel['UpdateFailed'] = false;
        if (
            substr($phpMussel['Components']['Meta'][$ThisTarget]['RemoteData'], 0, 4) === "---\n" &&
            ($phpMussel['Components']['EoYAML'] = strpos(
                $phpMussel['Components']['Meta'][$ThisTarget]['RemoteData'], "\n\n"
            )) !== false &&
            $phpMussel['YAML']->process(
                substr($phpMussel['Components']['Meta'][$ThisTarget]['RemoteData'], 4, $phpMussel['Components']['EoYAML'] - 4),
                $phpMussel['Components']['RemoteMeta']
            ) &&
            !empty($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Minimum Required']) &&
            !$phpMussel['VersionCompare'](
                $phpMussel['ScriptVersion'],
                $phpMussel['Components']['RemoteMeta'][$ThisTarget]['Minimum Required']
            ) &&
            (
                empty($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Minimum Required PHP']) ||
                !$phpMussel['VersionCompare'](PHP_VERSION, $phpMussel['Components']['RemoteMeta'][$ThisTarget]['Minimum Required PHP'])
            ) &&
            !empty($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['From']) &&
            !empty($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['To']) &&
            !empty($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Reannotate']) &&
            $phpMussel['Traverse']($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Reannotate']) &&
            ($ThisReannotate = $phpMussel['Components']['RemoteMeta'][$ThisTarget]['Reannotate']) &&
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
                "~(\n" . preg_quote($ThisTarget) . ":?)(\n [^\n]*)*\n~i",
                $phpMussel['Components']['OldMeta'],
                $phpMussel['Components']['OldMetaMatches']
            ) &&
            ($phpMussel['Components']['OldMetaMatches'] = $phpMussel['Components']['OldMetaMatches'][0]) &&
            ($phpMussel['Components']['NewMeta'] = $phpMussel['Components']['Meta'][$ThisTarget]['RemoteData']) &&
            preg_match(
                "~(\n" . preg_quote($ThisTarget) . ":?)(\n [^\n]*)*\n~i",
                $phpMussel['Components']['NewMeta'],
                $phpMussel['Components']['NewMetaMatches']
            ) &&
            ($phpMussel['Components']['NewMetaMatches'] = $phpMussel['Components']['NewMetaMatches'][0]) &&
            (!$phpMussel['FE']['CronMode'] || empty(
                $phpMussel['Components']['Meta'][$ThisTarget]['Tests']
            ) || $phpMussel['AppendTests']($phpMussel['Components']['Meta'][$ThisTarget], true))
        ) {
            $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']);
            $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['From']);
            $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['To']);
            if (!empty($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['Checksum'])) {
                $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['Checksum']);
            }
            $phpMussel['Components']['NewMeta'] = str_replace(
                $phpMussel['Components']['OldMetaMatches'],
                $phpMussel['Components']['NewMetaMatches'],
                $phpMussel['Components']['OldMeta']
            );
            $Count = count($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['From']);
            $phpMussel['RemoteFiles'] = [];
            $phpMussel['IgnoredFiles'] = [];
            $Rollback = false;
            /** Write new and updated files and directories. */
            for ($Iterate = 0; $Iterate < $Count; $Iterate++) {
                if (empty($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['To'][$Iterate])) {
                    continue;
                }
                $ThisFileName = $phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['To'][$Iterate];
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
                    !empty($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['Checksum'][$Iterate]) &&
                    !empty($phpMussel['Components']['Meta'][$ThisTarget]['Files']['Checksum'][$Iterate]) && (
                        $phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['Checksum'][$Iterate] ===
                        $phpMussel['Components']['Meta'][$ThisTarget]['Files']['Checksum'][$Iterate]
                    )
                ) {
                    $phpMussel['IgnoredFiles'][$ThisFileName] = true;
                    continue;
                }
                if (
                    empty($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['From'][$Iterate]) ||
                    !($ThisFile = $phpMussel['Request'](
                        $phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['From'][$Iterate]
                    ))
                ) {
                    $Iterate = 0;
                    $Rollback = true;
                    continue;
                }
                if (
                    strtolower(substr(
                        $phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['From'][$Iterate], -2
                    )) === 'gz' &&
                    strtolower(substr($ThisFileName, -2)) !== 'gz' &&
                    substr($ThisFile, 0, 2) === "\x1f\x8b"
                ) {
                    $ThisFile = gzdecode($ThisFile);
                }
                if (!empty($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['Checksum'][$Iterate])) {
                    $ThisChecksum = $phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['Checksum'][$Iterate];
                    $ThisLen = strlen($ThisFile);
                    if (
                        (md5($ThisFile) . ':' . $ThisLen) !== $ThisChecksum &&
                        (sha1($ThisFile) . ':' . $ThisLen) !== $ThisChecksum &&
                        (hash('sha256', $ThisFile) . ':' . $ThisLen) !== $ThisChecksum
                    ) {
                        $phpMussel['FE']['state_msg'] .=
                            '<code>' . $ThisTarget . '</code> – ' .
                            '<code>' . $ThisFileName . '</code> – ' .
                            $phpMussel['L10N']->getString('response_checksum_error') . '<br />';
                        if (!empty($phpMussel['Components']['Meta'][$ThisTarget]['On Checksum Error'])) {
                            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ThisTarget]['On Checksum Error'], true);
                        }
                        $Iterate = 0;
                        $Rollback = true;
                        continue;
                    }
                }
                if (
                    preg_match('~\.(?:css|dat|gif|inc|jpe?g|php|png|ya?ml|[a-z]{0,2}db)$~i', $ThisFileName) &&
                    !$phpMussel['SanityCheck']($ThisFileName, $ThisFile)
                ) {
                    $phpMussel['FE']['state_msg'] .= sprintf(
                        '<code>%s</code> – <code>%s</code> – %s<br />',
                        $ThisTarget,
                        $ThisFileName,
                        $phpMussel['L10N']->getString('response_sanity_1')
                    );
                    if (!empty($phpMussel['Components']['Meta'][$ThisTarget]['On Sanity Error'])) {
                        $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ThisTarget]['On Sanity Error'], true);
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
                    !empty($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['To']) &&
                    is_array($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['To'])
                ) {
                    array_walk($phpMussel['Components']['RemoteMeta'][$ThisTarget]['Files']['To'], function ($ThisFile) use (&$phpMussel) {
                        if (!empty($ThisFile) && $phpMussel['Traverse']($ThisFile)) {
                            $phpMussel['DeleteDirectory']($ThisFile);
                        }
                    });
                }
                $phpMussel['UpdateFailed'] = true;
            } else {
                /** Prune unwanted files and directories (update/install success). */
                if (!empty($phpMussel['Components']['Meta'][$ThisTarget]['Files']['To'])) {
                    $ThisArr = $phpMussel['Components']['Meta'][$ThisTarget]['Files']['To'];
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
                    $Annotations[$ThisReannotate] = $phpMussel['Components']['Meta'][$ThisTarget]['RemoteData'];
                }
                $phpMussel['FE']['state_msg'] .= '<code>' . $ThisTarget . '</code> – ';
                if (
                    empty($phpMussel['Components']['Meta'][$ThisTarget]['Version']) &&
                    empty($phpMussel['Components']['Meta'][$ThisTarget]['Files'])
                ) {
                    $phpMussel['FE']['state_msg'] .= $phpMussel['L10N']->getString('response_component_successfully_installed');
                    if (!empty($phpMussel['Components']['Meta'][$ThisTarget]['When Install Succeeds'])) {
                        $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ThisTarget]['When Install Succeeds'], true);
                    }
                } else {
                    $phpMussel['FE']['state_msg'] .= $phpMussel['L10N']->getString('response_component_successfully_updated');
                    if (!empty($phpMussel['Components']['Meta'][$ThisTarget]['When Update Succeeds'])) {
                        $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ThisTarget]['When Update Succeeds'], true);
                    }
                }
                $phpMussel['Components']['Meta'][$ThisTarget] = $phpMussel['Components']['RemoteMeta'][$ThisTarget];
            }
        } else {
            $phpMussel['UpdateFailed'] = true;
        }
        if ($phpMussel['UpdateFailed']) {
            $phpMussel['FE']['state_msg'] .= '<code>' . $ThisTarget . '</code> – ';
            if (
                empty($phpMussel['Components']['Meta'][$ThisTarget]['Version']) &&
                empty($phpMussel['Components']['Meta'][$ThisTarget]['Files'])
            ) {
                $phpMussel['FE']['state_msg'] .= $phpMussel['L10N']->getString('response_failed_to_install');
                if (!empty($phpMussel['Components']['Meta'][$ThisTarget]['When Install Fails'])) {
                    $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ThisTarget]['When Install Fails'], true);
                }
            } else {
                $phpMussel['FE']['state_msg'] .= $phpMussel['L10N']->getString('response_failed_to_update');
                if (!empty($phpMussel['Components']['Meta'][$ThisTarget]['When Update Fails'])) {
                    $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ThisTarget]['When Update Fails'], true);
                }
            }
        }
        $phpMussel['FormatFilesize']($phpMussel['Components']['BytesAdded']);
        $phpMussel['FormatFilesize']($phpMussel['Components']['BytesRemoved']);
        $phpMussel['FE']['state_msg'] .= sprintf(
            $phpMussel['FE']['CronMode'] ? " « +%s | -%s | %s »\n" : ' <code><span class="txtGn">+%s</span> | <span class="txtRd">-%s</span> | <span class="txtOe">%s</span></code><br />',
            $phpMussel['Components']['BytesAdded'],
            $phpMussel['Components']['BytesRemoved'],
            $phpMussel['NumberFormatter']->format(microtime(true) - $phpMussel['Components']['TimeRequired'], 3)
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

/**
 * Updates handler: Uninstall a component.
 *
 * @param string $ID The ID of the component to uninstall.
 */
$phpMussel['UpdatesHandler-Uninstall'] = function ($ID) use (&$phpMussel) {
    $InUse = $phpMussel['ComponentFunctionUpdatePrep']($ID);
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
            "~(\n" . preg_quote($ID) . ":?)(\n [^\n]*)*\n~i",
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
        $phpMussel['FE']['state_msg'] = $phpMussel['L10N']->getString('response_component_successfully_uninstalled');
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Uninstall Succeeds'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Uninstall Succeeds'], true);
        }
    } else {
        $phpMussel['FE']['state_msg'] = $phpMussel['L10N']->getString('response_component_uninstall_error');
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Uninstall Fails'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Uninstall Fails'], true);
        }
    }
    $phpMussel['FormatFilesize']($phpMussel['Components']['BytesRemoved']);
    $phpMussel['FE']['state_msg'] .= sprintf(
        $phpMussel['FE']['CronMode'] ? " « -%s | %s »\n" : ' <code><span class="txtRd">-%s</span> | <span class="txtOe">%s</span></code>',
        $phpMussel['Components']['BytesRemoved'],
        $phpMussel['NumberFormatter']->format(microtime(true) - $phpMussel['Components']['TimeRequired'], 3)
    );
};

/**
 * Updates handler: Activate a component.
 *
 * @param string $ID The ID of the component to activate.
 */
$phpMussel['UpdatesHandler-Activate'] = function ($ID) use (&$phpMussel) {
    $phpMussel['Activation'] = [
        'Config' => $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['FE']['ActiveConfigFile']),
        'Active' => $phpMussel['Config']['signatures']['Active'],
        'Modified' => false
    ];
    $InUse = $phpMussel['ComponentFunctionUpdatePrep']($ID);
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
        $phpMussel['FE']['state_msg'] = $phpMussel['L10N']->getString('response_activation_failed');
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Activation Fails'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Activation Fails'], true);
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
        $phpMussel['FE']['state_msg'] = $phpMussel['L10N']->getString('response_activated');
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Activation Succeeds'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Activation Succeeds'], true);
        }
    }
    /** Cleanup. */
    unset($phpMussel['Activation']);
};

/**
 * Updates handler: Deactivate a component.
 *
 * @param string $ID The ID of the component to deactivate.
 */
$phpMussel['UpdatesHandler-Deactivate'] = function ($ID) use (&$phpMussel) {
    $phpMussel['Deactivation'] = [
        'Config' => $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['FE']['ActiveConfigFile']),
        'Active' => $phpMussel['Config']['signatures']['Active'],
        'Modified' => false
    ];
    $InUse = $phpMussel['ComponentFunctionUpdatePrep']($ID);
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
        $phpMussel['FE']['state_msg'] = $phpMussel['L10N']->getString('response_deactivation_failed');
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Deactivation Fails'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Deactivation Fails'], true);
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
        $phpMussel['FE']['state_msg'] = $phpMussel['L10N']->getString('response_deactivated');
        if (!empty($phpMussel['Components']['Meta'][$ID]['When Deactivation Succeeds'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$ID]['When Deactivation Succeeds'], true);
        }
    }
    /** Cleanup. */
    unset($phpMussel['Deactivation']);
};

/**
 * Updates handler: Verify a component.
 *
 * @param string|array $ID The ID (or array of IDs) of the component(/s) to verify.
 */
$phpMussel['UpdatesHandler-Verify'] = function ($ID) use (&$phpMussel) {
    $phpMussel['Arrayify']($ID);
    foreach ($ID as $ThisID) {
        $Table = '<blockquote class="ng1 comSub">';
        if (empty($phpMussel['Components']['Meta'][$ThisID]['Files'])) {
            continue;
        }
        $TheseFiles = $phpMussel['Components']['Meta'][$ThisID]['Files'];
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
            $ThisFileData = $phpMussel['ReadFile']($phpMussel['Vault'] . $ThisFile);

            /** Sanity check. */
            if (
                preg_match('~\.(?:css|dat|gif|inc|jpe?g|php|png|ya?ml|[a-z]{0,2}db)$~i', $ThisFile)
            ) {
                $Class = $phpMussel['SanityCheck']($ThisFile, $ThisFileData) ? 'txtGn' : 'txtRd';
                $Sanity = sprintf('<span class="%s">%s</span>', $Class, $phpMussel['L10N']->getString(
                    $Class === 'txtGn' ? 'response_passed' : 'response_failed'
                ));
                if ($Class === 'txtRd') {
                    $Passed = false;
                }
            } else {
                $Sanity = sprintf('<span class="txtOe">%s</span>', $phpMussel['L10N']->getString('response_skipped'));
            }

            $Checksum = empty($TheseFiles['Checksum'][$Iterate]) ? '' : $TheseFiles['Checksum'][$Iterate];
            $Len = strlen($ThisFileData);
            $HashPartLen = strpos($Checksum, ':') ?: 64;
            if ($HashPartLen === 32) {
                $Actual = md5($ThisFileData) . ':' . $Len;
            } else {
                $Actual = (($HashPartLen === 40) ? sha1($ThisFileData) : hash('sha256', $ThisFileData)) . ':' . $Len;
            }

            /** Integrity check. */
            if ($Checksum) {
                if ($Actual !== $Checksum) {
                    $Class = 'txtRd';
                    $Passed = false;
                } else {
                    $Class = 'txtGn';
                }
                $Integrity = sprintf('<span class="%s">%s</span>', $Class, $phpMussel['L10N']->getString(
                    $Class === 'txtGn' ? 'response_passed' : 'response_failed'
                ));
            } else {
                $Class = 's';
                $Integrity = sprintf('<span class="txtOe">%s</span>', $phpMussel['L10N']->getString('response_skipped'));
            }

            /** Append results. */
            $Table .= sprintf(
                '<code>%1$s</code> – %7$s%8$s – %9$s%10$s<br />%2$s – <code class="%6$s">%3$s</code><br />%4$s – <code class="%6$s">%5$s</code><hr />',
                $ThisFile,
                $phpMussel['L10N']->getString('label_actual'),
                $Actual ?: '?',
                $phpMussel['L10N']->getString('label_expected'),
                $Checksum ?: '?',
                $Class,
                $phpMussel['L10N']->getString('label_integrity_check'),
                $Integrity,
                $phpMussel['L10N']->getString('label_sanity_check'),
                $Sanity
            );
        }
        $Table .= '</blockquote>';
        $phpMussel['FE']['state_msg'] .= sprintf(
            '<div><span class="comCat" style="cursor:pointer"><code>%s</code> – <span class="%s">%s</span></span>%s</div>',
            $ThisID,
            ($Passed ? 's' : 'txtRd'),
            $phpMussel['L10N']->getString($Passed ? 'response_verification_success' : 'response_verification_failed'),
            $Table
        );
    }
};

/**
 * Normalise linebreaks.
 *
 * @param string $Data The data to normalise.
 */
$phpMussel['NormaliseLinebreaks'] = function (&$Data) {
    if (strpos($Data, "\r")) {
        $Data = (strpos($Data, "\r\n") !== false) ? str_replace("\r", '', $Data) : str_replace("\r", "\n", $Data);
    }
};

/**
 * Signature information handler.
 *
 * @param array $Active The currently active signature files.
 */
$phpMussel['SigInfoHandler'] = function (array $Active) use (&$phpMussel) {

    /** Check whether shorthand data has been fetched. If it hasn't, fetch it. */
    if (!isset($phpMussel['shorthand.yaml'])) {
        if (!file_exists($phpMussel['Vault'] . 'shorthand.yaml') || !is_readable($phpMussel['Vault'] . 'shorthand.yaml')) {
            return '<span class="s">' . $phpMussel['L10N']->getString('response_error') . '</span>';
        }
        $phpMussel['shorthand.yaml'] = (new \Maikuolan\Common\YAML($phpMussel['ReadFile']($phpMussel['Vault'] . 'shorthand.yaml')))->Data;
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
        $Label = $phpMussel['L10N']->getString('siginfo_sub_' . $Sub) ?: $Sub;
        $Class = 'sigtype_' . strtolower($Sub);
        $phpMussel['FE']['infoCatOptions'] .= "\n      <option value=\"" . $Class . '">' . $Label . '</option>';
        $ThisTable = '<span style="display:none" class="' . $Class . '"><table><tr><td class="center h4f" colspan="2"><span class="s">' . $Label . '</span></td></tr>' . "\n";
        arsort($Totals[$Sub]);
        foreach ($Totals[$Sub] as $Key => &$Total) {
            if (!$Total) {
                continue;
            }
            $Total = $phpMussel['NumberFormatter']->format($Total);
            $Label = $phpMussel['L10N']->getString(
                ($Key === 'Other' && $Sub === 'SigTypes') ? 'siginfo_key_Other_Metadata' : 'siginfo_key_' . $Key
            );
            if ($Key !== 'Total' && $Key !== 'Other') {
                if (!$Label) {
                    $Label = sprintf($phpMussel['L10N']->getString('siginfo_xkey'), $Key);
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

/**
 * Assign some basic variables (initial prepwork for most front-end pages).
 *
 * @param string $Title The page title.
 * @param string $Tips The page "tip" to include ("Hello username! Here you can...").
 * @param bool $JS Whether to include the standard front-end JavaScript boilerplate.
 */
$phpMussel['InitialPrepwork'] = function ($Title = '', $Tips = '', $JS = true) use (&$phpMussel) {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = 'phpMussel – ' . $Title;

    /** Fetch and prepare username. */
    if ($Username = (empty($phpMussel['FE']['UserRaw']) ? '' : $phpMussel['FE']['UserRaw'])) {
        $Username = preg_replace('~^([^<>]+)<[^<>]+>$~', '\1', $Username);
        if (($AtChar = strpos($Username, '@')) !== false) {
            $Username = substr($Username, 0, $AtChar);
        }
    }

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](['username' => $Username], $Tips);

    /** Load main front-end JavaScript data. */
    $phpMussel['FE']['JS'] = $JS ? $phpMussel['ReadFile']($phpMussel['GetAssetPath']('scripts.js')) : '';

};

/**
 * Send page output for front-end pages (plus some other final prepwork).
 *
 * @return string Page output.
 */
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
    static $Pattern_PHPMailer_EventLog = false;
    if (!$Pattern_PHPMailer_EventLog && $phpMussel['Config']['PHPMailer']['EventLog']) {
        $Pattern_PHPMailer_EventLog = $phpMussel['BuildLogPattern']($phpMussel['Config']['PHPMailer']['EventLog'], true);
    }
    return preg_match('~\.log(?:\.gz)?$~', strtolower($File)) || (
        $phpMussel['Config']['general']['scan_log'] && preg_match($Pattern_scan_log, $File)
    ) || (
        $phpMussel['Config']['general']['scan_log_serialized'] && preg_match($Pattern_scan_log_serialized, $File)
    ) || (
        $phpMussel['Config']['general']['scan_kills'] && preg_match($Pattern_scan_kills, $File)
    ) || (
        $phpMussel['Config']['general']['FrontEndLog'] && preg_match($Pattern_FrontEndLog, $File)
    ) || (
        $phpMussel['Config']['PHPMailer']['EventLog'] && preg_match($Pattern_PHPMailer_EventLog, $File)
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
    $Confirm = str_replace(["'", '"'], ["\'", '\x22'], sprintf($phpMussel['L10N']->getString('confirm_action'), $Action));
    return 'javascript:confirm(\'' . $Confirm . '\')&&document.getElementById(\'' . $Form . '\').submit()';
};

/**
 * A quicker way to add entries to the front-end logfile.
 *
 * @param string $IPAddr The IP address triggering the log event.
 * @param string $User The user triggering the log event.
 * @param string $Message The message to be logged.
 */
$phpMussel['FELogger'] = function ($IPAddr, $User, $Message) use (&$phpMussel) {
    if (!$phpMussel['Config']['general']['FrontEndLog'] || empty($phpMussel['FE']['DateTime'])) {
        return;
    }
    $File = (strpos($phpMussel['Config']['general']['FrontEndLog'], '{') !== false) ? $phpMussel['TimeFormat'](
        $phpMussel['Time'],
        $phpMussel['Config']['general']['FrontEndLog']
    ) : $phpMussel['Config']['general']['FrontEndLog'];
    $Data = $phpMussel['Config']['legal']['pseudonymise_ip_addresses'] ? $phpMussel['Pseudonymise-IP']($IPAddr) : $IPAddr;
    $Data .= ' - ' . $phpMussel['FE']['DateTime'] . ' - "' . $User . '" - ' . $Message . "\n";
    $WriteMode = (!file_exists($phpMussel['Vault'] . $File) || (
        $phpMussel['Config']['general']['truncate'] > 0 &&
        filesize($phpMussel['Vault'] . $File) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
    )) ? 'w' : 'a';
    if ($phpMussel['BuildLogPath']($File)) {
        $Handle = fopen($phpMussel['Vault'] . $File, $WriteMode);
        fwrite($Handle, $Data);
        fclose($Handle);
        if ($WriteMode === 'w') {
            $phpMussel['LogRotation']($phpMussel['Config']['general']['FrontEndLog']);
        }
    }
};

/**
 * Wrapper for PHPMailer functionality.
 *
 * @param array $Recipients An array of recipients to send to.
 * @param string $Subject The subject line of the email.
 * @param string $Body The HTML content of the email.
 * @param string $AltBody The alternative plain-text content of the email.
 * @param array $Attachments An optional array of attachments.
 * @return bool Operation failed (false) or succeeded (true).
 */
$phpMussel['SendEmail'] = function (array $Recipients = [], $Subject = '', $Body = '', $AltBody = '', array $Attachments = []) use (&$phpMussel) {
    $EventLog = '';
    $EventLogData = '';

    /** Prepare event logging. */
    if ($phpMussel['Config']['PHPMailer']['EventLog']) {
        $EventLog = (strpos($phpMussel['Config']['PHPMailer']['EventLog'], '{') !== false) ? $phpMussel['TimeFormat'](
            $phpMussel['Time'],
            $phpMussel['Config']['PHPMailer']['EventLog']
        ) : $phpMussel['Config']['PHPMailer']['EventLog'];
        $EventLogData = ((
            $phpMussel['Config']['legal']['pseudonymise_ip_addresses']
        ) ? $phpMussel['Pseudonymise-IP']($_SERVER[$phpMussel['IPAddr']]) : $_SERVER[$phpMussel['IPAddr']]) . ' - ' . (
            isset($phpMussel['FE']['DateTime']) ? $phpMussel['FE']['DateTime'] : $phpMussel['TimeFormat'](
                $phpMussel['Time'],
                $phpMussel['Config']['general']['timeFormat']
            )
        ) . ' - ';
        $WriteMode = (!file_exists($phpMussel['Vault'] . $EventLog) || (
            $phpMussel['Config']['general']['truncate'] > 0 &&
            filesize($phpMussel['Vault'] . $EventLog) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
        )) ? 'w' : 'a';
    }

    /** Operation success state. */
    $State = false;

    /** Check whether class exists to either load it and continue or fail the operation. */
    if (!class_exists('\PHPMailer\PHPMailer\PHPMailer')) {
        if ($EventLog) {
            $EventLogData .= $phpMussel['L10N']->getString('state_failed_missing') . "\n";
        }
    } else {
        try {

            /** Create a new PHPMailer instance. */
            $Mail = new \PHPMailer\PHPMailer\PHPMailer();

            /** Tell PHPMailer to use SMTP. */
            $Mail->isSMTP();

            /** Disable debugging. */
            $Mail->SMTPDebug = 0;

            /** Skip authorisation process for some extreme problematic cases. */
            if ($phpMussel['Config']['PHPMailer']['SkipAuthProcess']) {
                $Mail->SMTPOptions = ['ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]];
            }

            /** Set mail server hostname. */
            $Mail->Host = $phpMussel['Config']['PHPMailer']['Host'];

            /** Set the SMTP port. */
            $Mail->Port = $phpMussel['Config']['PHPMailer']['Port'];

            /** Set the encryption system to use. */
            if (
                !empty($phpMussel['Config']['PHPMailer']['SMTPSecure']) &&
                $phpMussel['Config']['PHPMailer']['SMTPSecure'] !== '-'
            ) {
                $Mail->SMTPSecure = $phpMussel['Config']['PHPMailer']['SMTPSecure'];
            }

            /** Set whether to use SMTP authentication. */
            $Mail->SMTPAuth = $phpMussel['Config']['PHPMailer']['SMTPAuth'];

            /** Set the username to use for SMTP authentication. */
            $Mail->Username = $phpMussel['Config']['PHPMailer']['Username'];

            /** Set the password to use for SMTP authentication. */
            $Mail->Password = $phpMussel['Config']['PHPMailer']['Password'];

            /** Set the email sender address and name. */
            $Mail->setFrom(
                $phpMussel['Config']['PHPMailer']['setFromAddress'],
                $phpMussel['Config']['PHPMailer']['setFromName']
            );

            /** Set the optional "reply to" address and name. */
            if (
                !empty($phpMussel['Config']['PHPMailer']['addReplyToAddress']) &&
                !empty($phpMussel['Config']['PHPMailer']['addReplyToName'])
            ) {
                $Mail->addReplyTo(
                    $phpMussel['Config']['PHPMailer']['addReplyToAddress'],
                    $phpMussel['Config']['PHPMailer']['addReplyToName']
                );
            }

            /** Used by logging when send succeeds. */
            $SuccessDetails = '';

            /** Set the recipient address and name. */
            foreach ($Recipients as $Recipient) {
                if (empty($Recipient['Address']) || empty($Recipient['Name'])) {
                    continue;
                }
                $Mail->addAddress($Recipient['Address'], $Recipient['Name']);
                $SuccessDetails .= (($SuccessDetails) ? ', ' : '') . $Recipient['Name'] . ' <' . $Recipient['Address'] . '>';
            }

            /** Set the subject line of the email. */
            $Mail->Subject = $Subject;

            /** Tell PHPMailer that the email is written using HTML. */
            $Mail->isHTML = true;

            /** Set the HTML body of the email. */
            $Mail->Body = $Body;

            /** Set the alternative, plain-text body of the email. */
            $Mail->AltBody = $AltBody;

            /** Process attachments. */
            foreach ($Attachments as $Attachment) {
                $Mail->addAttachment($Attachment);
            }

            /** Send it! */
            $State = $Mail->send();

            /** Log the results of the send attempt. */
            if ($EventLog) {
                $EventLogData .= ($State ? sprintf(
                    $phpMussel['L10N']->getString('state_email_sent'),
                    $SuccessDetails
                ) : $phpMussel['L10N']->getString('response_error') . ' - ' . $Mail->ErrorInfo) . "\n";
            }

        } catch (\Exception $e) {

            /** An exeption occurred. Log the information. */
            if ($EventLog) {
                $EventLogData .= $phpMussel['L10N']->getString('response_error') . ' - ' . $e->getMessage() . "\n";
            }

        }
    }

    /** Write to the event log. */
    if ($EventLog) {
        $Handle = fopen($phpMussel['Vault'] . $EventLog, $WriteMode);
        fwrite($Handle, $EventLogData);
        fclose($Handle);
        if ($WriteMode === 'w') {
            $phpMussel['LogRotation']($phpMussel['Config']['PHPMailer']['EventLog']);
        }
    }

    /** Exit. */
    return $State;
};

/**
 * Generates very simple 8-digit numbers used for 2FA.
 *
 * @return int An 8-digit number.
 */
$phpMussel['2FA-Number'] = function () {
    static $MinInt = 10000000;
    static $MaxInt = 99999999;
    if (function_exists('random_int')) {
        try {
            $Key = random_int($MinInt, $MaxInt);
        } catch (\Exception $e) {
            $Key = rand($MinInt, $MaxInt);
        }
    }
    return isset($Key) ? $Key : rand($MinInt, $MaxInt);
};

/**
 * Generate a clickable list from an array.
 *
 * @param array $Arr The array to convert from.
 * @param string $DeleteKey The key to use for async calls to delete a cache entry.
 * @param int $Depth Current cache entry list depth.
 * @param string $ParentKey An optional key of the parent data source.
 * @return string The generated clickable list.
 */
$phpMussel['ArrayToClickableList'] = function (array $Arr = [], $DeleteKey = '', $Depth = 0, $ParentKey = '') use (&$phpMussel) {
    $Output = '';
    $Count = count($Arr);
    $Prefix = substr($DeleteKey, 0, 2) === 'fe' ? 'FE' : '';
    foreach ($Arr as $Key => $Value) {
        $Delete = ($Depth === 0) ? ' – (<span style="cursor:pointer" onclick="javascript:' . $DeleteKey . '(\'' . addslashes($Key) . '\')"><code class="s">' . $phpMussel['L10N']->getString('field_delete_file') . '</code></span>)' : '';
        $Output .= ($Depth === 0 ? '<span id="' . $Key . $Prefix . 'Container">' : '') . '<li>';
        if (!is_array($Value)) {
            if (substr($Value, 0, 2) === '{"' && substr($Value, -2) === '"}') {
                $Try = json_decode($Value, true);
                if ($Try !== null) {
                    $Value = $Try;
                }
            } elseif (
                preg_match('~\.ya?ml$~i', $Key) ||
                (preg_match('~^(?:Data|\d+)$~', $Key) && preg_match('~\.ya?ml$~i', $ParentKey)) ||
                substr($Value, 0, 4) === "---\n"
            ) {
                $Try = new \Maikuolan\Common\YAML();
                if ($Try->process($Value, $Try->Data) && !empty($Try->Data)) {
                    $Value = $Try->Data;
                }
            } elseif (substr($Value, 0, 2) === '["' && substr($Value, -2) === '"]' && strpos($Value, '","') !== false) {
                $Value = explode('","', substr($Value, 2, -2));
            }
        }
        if (is_array($Value)) {
            if ($Depth === 0) {
                $SizeField = $phpMussel['L10N']->getString('field_size') ?: 'Size';
                $Size = isset($Value['Data']) && is_string($Value['Data']) ? strlen($Value['Data']) : (
                    isset($Value[0]) && is_string($Value[0]) ? strlen($Value[0]) : false
                );
                if ($Size !== false) {
                    $phpMussel['FormatFilesize']($Size);
                    $Value[$SizeField] = $Size;
                }
            }
            $Output .= '<span class="comCat" style="cursor:pointer"><code class="s">' . str_replace(['<', '>'], ['&lt;', '&gt;'], $Key) . '</code></span>' . $Delete . '<ul class="comSub">';
            $Output .= $phpMussel['ArrayToClickableList']($Value, $DeleteKey, $Depth + 1, $Key);
            $Output .= '</ul>';
        } else {
            if ($Key === 'Time' && preg_match('~^\d+$~', $Value)) {
                $Key = $phpMussel['L10N']->getString('label_expires');
                $Value = $phpMussel['TimeFormat']($Value, $phpMussel['Config']['general']['timeFormat']);
            }
            $Class = ($Key === $phpMussel['L10N']->getString('field_size') || $Key === $phpMussel['L10N']->getString('label_expires')) ? 'txtRd' : 's';
            $Text = ($Count === 1 && $Key === 0) ? $Value : $Key . ($Class === 's' ? ' => ' : '') . $Value;
            $Output .= '<code class="' . $Class . '" style="word-wrap:break-word;word-break:break-all">' . str_replace(['<', '>'], ['&lt;', '&gt;'], $Text) . '</code>' . $Delete;
        }
        $Output .= '</li>' . ($Depth === 0 ? '<br /></span>' : '');
    }
    return $Output;
};

/**
 * Append to the current state message.
 *
 * @param string $Message What to append.
 */
$phpMussel['Message'] = function ($Message) use (&$phpMussel) {
    if (isset($phpMussel['FE']['state_msg'])) {
        if ($phpMussel['FE']['state_msg'] || substr($phpMussel['FE']['state_msg'], -6) !== '<br />') {
            $phpMussel['FE']['state_msg'] .= '<br />';
        }
        $phpMussel['FE']['state_msg'] .= $Message . '<br />';
    }
};

/**
 * Attempt to perform some simple formatting for the log data.
 *
 * @param string $In The log data to be formatted.
 */
$phpMussel['Formatter'] = function (&$In) {
    if (strpos($In, "<br />\n") === false) {
        $In = '<div class="fW">' . $In . '</div>';
        return;
    }
    if (strpos($In, "<br />\n<br />\n") !== false) {
        $Data = array_filter(explode("<br />\n<br />\n", $In));
        $SeparatorType = 0;
    } elseif (strpos($In, "\n&gt;") !== false) {
        $Data = preg_split("~(<br />\n(?!-|&gt;)[^\n]+)\n(?!-|&gt;)~i", $In, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $SeparatorType = 1;
    } else {
        $Data = array_filter(explode("<br />\n", $In));
        $SeparatorType = 2;
    }
    $In = '';
    if ($SeparatorType === 1) {
        $Blocks = count($Data);
        for ($Block = 0; $Block < $Blocks; $Block += 2) {
            $Darken = empty($Darken);
            $In .= '<div class="h' . ($Darken ? 'B' : 'W') . ' hFd fW">' . $Data[$Block] . $Data[$Block + 1] . "\n</div>";
        }
        $In = '<div style="filter:saturate(60%)"><span class="s">' . $In . '</span></div>';
        return;
    }
    foreach ($Data as &$Block) {
        $Darken = empty($Darken);
        $Block = '<div class="h' . ($Darken ? 'B' : 'W') . ' hFd fW">' . $Block;
        $Block .= $SeparatorType === 0 ? "<br />\n<br />\n</div>" : "<br />\n</div>";
        if ($SeparatorType === 2) {
            $Block = preg_replace([
                '~(a\:\d+\:)\{~',
                '~("|\d);\}~',
                '~\:(\d+)~',
                '~\:"([^"]+)"~'
            ], [
                '\1<span class="txtRd">{</span>',
                '\1;<span class="txtRd">}</span>',
                ':<span class="txtGn">\1</span>',
                ':"<span class="txtBl">\1</span>"'
            ], $Block);
        }
    }
    $In = '<div style="filter:saturate(60%)"><span class="' . (
        $SeparatorType === 2 ? 'txtOe' : 's'
    ) . '">' . implode('', $Data) . '</span></div>';
};

/**
 * Supplied string is used to generate arbitrary values used as RGB information
 * for CSS styling.
 *
 * @param string $String The supplied string to use.
 * @param int $Mode Whether to return the values as an array of integers,
 *      a hash-like string, or both.
 * @return string|array an array of integers, a hash-like string, or both.
 */
$phpMussel['RGB'] = function ($String = '', $Mode = 0) {
    $Diff = [247, 127, 31];
    if (is_string($String) && !empty($String)) {
        $String = str_split($String);
        foreach ($String as $Char) {
            $Char = ord($Char);
            $Diff[0] = ($Diff[0] >> 1) + (($Diff[2] & 1) === 1 ? 128 : 0);
            $Diff[1] = ($Diff[1] >> 1) + (($Diff[0] & 1) === 1 ? 128 : 0);
            $Diff[2] = ($Diff[2] >> 1) + (($Diff[1] & 1) === 1 ? 128 : 0);
            $Diff[0] ^= $Char;
        }
    }
    if ($Mode === 1) {
        return $Diff;
    }
    for ($Hash = '', $Index = 0; $Index < 3; $Index++) {
        $Hash .= str_pad(bin2hex(chr($Diff[$Index])), 2, '0', STR_PAD_LEFT);
    }
    if ($Mode === 2) {
        return $Hash;
    }
    return ['Values' => $Diff, 'Hash' => $Hash];
};
