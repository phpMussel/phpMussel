*[A canonical link to the file you're currently reading.](https://github.com/phpMussel/phpMussel/blob/v1/CONTRIBUTING.md)*

## **Want to help?**

If you want to report bugs, suggest new features, etc, you should start at the [issues](https://github.com/phpMussel/phpMussel/issues) page. Any already reported bugs, requested features, progress checklists, ideas, project discussions, etc should available there, and everyone is welcome to participate and contribute. If you have something to add, whether for an existing issue or a new issue, feel free to do so.

The project is open-source, released by its author under the [GNU/GPLv2 license](https://github.com/phpMussel/phpMussel/blob/v1/LICENSE.txt), so if you want fork/copy the project and to make your own modifications, you're welcome to do so. If you feel that your modifications could be beneficial to the project and its community, consider sending a [pull request](https://github.com/phpMussel/phpMussel/pulls) (include a description with pull requests, so that we know what we're looking at) so that we can review your modifications and consider integrating them as part of the project.

Anyone interested in contributing to the project is encouraged to do so.

### **Not sure how to help? Here are some things you could do.**
- **Have any unused free time to spare?** Projects always consume time, especially when they're free, open-source projects. Available time is often limited by employment, personal, social, familial, and other such commitments. If you're able to help out at all, and able to offer some of your time, the project could move forward a little faster, and time could be freed up for other contributors, so, this would always be welcomed.
- **Good at coding?** Check the issues page and see whether there's anything we're stuck on, or whether there's anything you could help us out with. Consider reviewing the codebase. If you see something that you think could be improved, feel free to have a go at it.
- **Good at thinking of new ideas or new features, or have something specific in mind that you'd like to see implemented?** Share your ideas with us. If we like your idea, we might implement it. Regardless, we welcome everyone to share their ideas.
- **Good at unit testing?** Consider helping us implement better tests.
- **Good at benchmarking?** If you'd be willing to test the codebase on your system, or willing to benchmark it, let us know what works, what doesn't work, and consider sharing your benchmarks and other findings, to help us find ways to improve the codebase and the project overall.
- **Good at pentesting? Good at finding bugs?** If you find any problems, any bugs, anything dangerous in the codebase, etc, let us know so that we can work on it.
- **Good at writing documentation?** If you'd be willing to review our documentation, to add anything that could be missing, to improve on it at all, this would be welcome.
- **Good at writing guides and tutorials?** Not all users enjoy reading documentation. Some users prefer guides and tutorials. For some users, just reading documentation isn't enough. They want practical, step by step tutorials, on how to achieve specific goals, or guides to provide perspective from other users, about the best ways to utilise the project. If you can provide this somehow, it could be very useful.
- **Good at translations? Know more than one language?** Please consider translating the project's documentation and L10N data into your own native language, or any other languages that you know, if this hasn't already been done. Otherwise, please consider reviewing existing translations, documentation, and L10N data, to help find and fix any spelling, grammar, or other typographical errors that may be there.
- **Good at reviewing? Good at quality control?** If there are any pending pull requests that haven't yet been reviewed or accepted, please consider offering to review them, offer feedback, suggestions, etc.
- **Good at refactoring?** Check out the codebase and see whether there's anything you could do for it.
- **Good at social networking? Good at sharing?** Please consider spreading word about the project. If you know anyone that you think could benefit from the project, let them know about it. Write about the project, review it, and share it onward.

### **phpMussel code style guidelines.**

From here onward in this document, the words "MUST", "MUST NOT", "SHOULD", "SHOULD NOT", and "MAY" are to be interpreted in accordance with *[RFC 2119](https://www.ietf.org/rfc/rfc2119.txt)*.

phpMussel adopts and adheres to *[PSR-1: Basic Coding Standard](https://www.php-fig.org/psr/psr-1/)*, *[PSR-2: Coding Style Guide](https://www.php-fig.org/psr/psr-2/)*, and *[PSR-4: Autoloader](https://www.php-fig.org/psr/psr-4/)* (as closely as possible, and to the best of our abilities). Whenever possible, any and all future contributions to the codebase SHOULD adopt and adhere to these standards, too. If you're unfamiliar with these, I would recommend reading them carefully.

phpMussel adopts *[PHPDoc](https://docs.phpdoc.org/references/phpdoc/index.html)* to annotate and describe PHP code. If you're unfamiliar with this, I would recommend reading the linked documentation carefully.

To avoid unnecessary complexity, red tape, or hindrances to future contributions, future contributions will be measured against any other PSRs or style guides not yet mentioned, IF and WHEN it becomes relevant and useful to do so (i.e., we'll cross those bridges when we get to them). To be more concise and to avoid unnecessary duplication in this document, any points already covered, either by this document, or by any linked documents (e.g., the PSRs adopted by this project), won't be repeated.

All code (foremostly PHP code, but also any other code), and all markup (including markdown files, HTML, etc) attached to the project MUST utilise Unix-style LF newlines. All INI files (the project only contains one such file) MUST utilise Windows-style CRLF newlines.

To the exclusion of all "binary" files (e.g., images, compressed archives, etc), all project files (including all code, markup, etc) MUST utilise UTF-8 encoding (without BOM), and MUST NOT contain any trailing whitespace.

All YAML files, and all YAML data attached to the project, MUST indent (when indenting is necessary) using exactly one space (not tabs), and must do so consistently. All HTML files, and all HTML data attached to the project, SHOULD indent (when indenting is necessary) using exactly two spaces (not tabs), and must do so consistently. All CSS files, and all CSS data attached to the project, SHOULD indent (when indenting is necessary) using exactly two spaces (not tabs), and must do so consistently. HTML, CSS, and JavaScript MAY be "minified", *on the condition* that it doesn't negatively impact the maintainability of the project. Other files, and other types of data, SHOULD NOT be "minified". When writing code or markup, contributors SHOULD aim for maximum readability, and maximum maintainability for their contributions.

All PHP functions, methods, and closures MUST be properly and accurately annotated by an attached DocBlock. All PHP files MUST contain a DocBlock header, to describe the general nature of the file. All attached DocBlocks SHOULD be concise, and SHOULD NOT be overly verbose (i.e., containing more than necessary). All comments in all PHP files and code MUST conform to PHPDoc (i.e., as DocComments). Where the purpose and intent of some particular code is highly obtuse, unclear, or not easily understood, it SHOULD be commented. Where the purpose and intent of some particular code is highly transparent and easily stood (and where not otherwise already dictated by this document), it SHOULD NOT be commented. All annotation, and all comments, MUST be written in English.

From v2 onward, all phpMussel configuration directives MUST be named in accordance with *[snake case](https://en.wikipedia.org/wiki/Snake_case)* (i.e., lowercase, and words separated by an underscore), and MUST NOT be named using any characters other than standard English letters (A through Z) and underscores.

### **phpMussel version release guidelines.**

phpMussel adopts and adheres to *[SemVer](https://semver.org/) (Semantic Versioning)*. If you're unfamiliar with this, I would recommend reading the linked documentation carefully.

Extending upon the rules provided by SemVer, the following are to be interpreted as backwards-incompatible changes:
- Anything that increases the minimum PHP version requirement.
- The permanent removal of any features or configuration directives.
- Anything that changes the syntax used by signatures, signature files, or the front-end updates page components metadata in a backwards-incompatible manner.
- Adding any new external, third-party dependencies to the project at all (e.g., through Composer).

When tagging a new release, the "tag version" MUST be formatted as "vM.m.p" (where, per SemVer definitions, "M" is the MAJOR version number, "m" is the MINOR version number, and "p" is the PATCH version number), and the "release title" MUST be formatted as "phpMussel vM.m.p". The release description SHOULD contain all relevant changes implemented since the previous most recent release targeted to the same branch. The release description SHOULD NOT contain anything irrelevant to the release.

Any version/release schema provided and declared by any third-party components attached to phpMussel MUST be honoured (in the context of those third-party components). Plugins SHOULD also adopt and adhere to SemVer, but this decision is ultimately the responsibility of the plugin author/maintainer (and therefore not the responsibility of phpMussel to enforce). Otherwise, any components attached to phpMussel that aren't clearly distinguishable in terms of MAJOR, MINOR, or PATCH version numbers (e.g., the signature files, the L10N data, etc), SHOULD be *de facto* versioned as "Y.z.B" (where, at the exact time of *de facto* versioning, "Y" is the current year, "z" is a number, 0 through 365, representing the current day of the year, and "B" is the current *[swatch time](https://en.wikipedia.org/wiki/Swatch_Internet_Time)*).

### **phpMussel documentation and translation guidelines.**

All formal documentation for phpMussel, and all of the translations for that documentation, can be found in the *[phpMussel/Docs](https://github.com/phpMussel/Docs)* repository. All formal documentation is written and provided as markdown.

All the L10N data for phpMussel, and all of the translations for that L10N data, can be found in the `vault/lang` directory of the *[phpMussel/phpMussel](https://github.com/phpMussel/phpMussel)* repository (the main phpMussel repository). Each major version branch contains its own L10N data (whatever L10N data is pertinent to that particular major version), and due to different L10N needs between different major versions, L10N data between branches mightn't necessarily be the same (this should be kept in mind when planning to send pull requests to change any L10N data). All the L10N data for phpMussel is written and provided as YAML.

Regardless of whether for the documentation or for the L10N data, the specific language of any particular translation can be identified by its two-letter *[ISO 639-1](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes)* language code. When a particular regional dialect or country variant needs to be identified, a two-letter *[ISO 3166-2](https://en.wikipedia.org/wiki/ISO_3166-2)* code can be appended (but this should be avoided when the distinction is unimportant).

The most efficient way to create new translations is to locate the English version of the documentation or L10N data (whichever you're wanting to translate), duplicate the files, change the "en" part of the names of the files (the ISO 639-1 code for English) to the ISO 639-1 code that corresponds to the target language, open the files, translate as necessary, and when finished, send a pull request with the newly created translations.

### **When sending pull requests, which branch should I target?**

For the main codebase, branches are named according to major version. Therefore, if you want to affect something in v1, target the v1 branch; if you want to affect something in v2, target the v2 branch; and so on. If a branch exists for a specific feature, a specific planned task, or similar, and that's the thing that you're working on, target that branch instead. If no branch exists for the particular major version you're wanting to affect, or if you feel that you need to be able to target your pull request somewhere else, you can ask for a new branch to be created. Target master only if no other alternatives are available.

For the documentation repository, master is the only branch (we don't need any other branches), so just always target master.

---


Last Updated: 9 May 2019 (2019.05.09).
