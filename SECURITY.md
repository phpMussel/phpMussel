# Security Policy

## Supported Versions

Please refer to the "[current major version development status](https://github.com/phpMussel/phpMussel#current-major-version-development-status)" listed at this repository's README.

## Reporting a Vulnerability

If you've discovered a new vulnerability, please firstly attempt to reasonably confirm which versions of the package the newly discovered vulnerability affects.

If it affects only versions on branches that've already reached "EoL/Dead" status (i.e., doesn't affect anything on any currently maintained branches, tagged or otherwise), it most likely won't ever be fixed, and the best course of action would be to report all pertinent details directly to the issues page at this repository. We can then document the vulnerability and encourage any affected users to update to a non-affected version as soon as possible.

If it affects any versions on any currently maintained branches (tagged or otherwise, and including any active dev code), we'll do what we can to fix the problem as soon as possible (assuming that it hasn't already been fixed since the latest available versions at the affected branches).

If the vulnerability has already been fixed, is already public knowledge, or has otherwise already been publicly disclosed somehow by the project somewhere (e.g., in our changelogs, at our Gitter channel, at our GitHub issues page, etc), the best course of action would be to report all pertinent details directly to the issues page at this repository. If an issue concerning the vulnerability already exists, we would ask that you append your report to that issue, rather than creating additional issues (to avoid duplicity and clutter at the issues page). If no such issue exists yet, we welcome you to create one.

However, if the vulnerability hasn't been fixed yet, isn't yet public knowledge, and hasn't yet been publicly disclosed by the project anywhere (e.g., no relevant issues created yet and nothing at any of our channels; i.e., if you've found a "zero-day"), we would ask then that you keep user safety in mind and to report your findings in a responsible, conscientious manner. Public disclosure of previously unknown vulnerabilities and "zero-days", when affecting currently supported versions, could directly put users at risk from those that may wish to do them, their websites, or their data harm. (This, of course, refers only to vulnerabilities; Bugs or faults in the codebase that wouldn't generally be regarded as vulnerabilities could still be posted directly to the issues page).

In cases where reporting to the issues page or to publicly accessible channels would pose such risks to users, or where private communication may be required for any particular reason, you're welcome to contact [me](https://github.com/Maikuolan) ([082e6bc1046fab95](https://peegeepee.com/046FAB95)) by other means (such as email or private messaging).

## Currently Known Vulnerabilities

### Phar unserialization vulnerability.
- **Description:** phpMussel's *former* reliance upon PHP's phar wrapper for reading archives means that an unserialization vulnerability in PHP's phar wrapper is exploitable at the affected phpMussel versions. There aren't any known cases of exploitation in the wild, but uploading a specially crafted file to an affected version allows arbitrary code execution (discovered, tested, and confirmed by [myself](https://github.com/Maikuolan)), so the risk factor should be regarded as __very high__. Newer phpMussel versions don't use PHP's phar wrapper, and are therefore unaffected.
- **Related issues:** [#167](https://github.com/phpMussel/phpMussel/issues/167)
- **Affected versions:** phpMussel >= 1.0.0 < 1.6.0
- **Solution:** Update to phpMussel v1.6.0 or newer. Alternatively, if updating isn't possible, disable archive checking entirely by setting the "*check_archives*" configuration directive to "*false*" (thus avoiding execution of the affected parts of the codebase entirely). There doesn't seem to be any fix for the phar wrapper vulnerability, meaning that changing PHP versions won't do anything to solve the problem here.
