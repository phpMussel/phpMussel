      _____  _     _  _____  _______ _     _ _______ _______ _______           
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    
 Thank you for using phpMussel, a php-based script based upon ClamAV signatures
  designed to detect trojans, viruses, malware and other threats within files  
             uploaded to your system wherever the script is hooked.            
     PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2 by Caleb M (Maikuolan)    
 
                                  ~ ~ ~                                        
 
 
 CONTENTS
 1. PRE-RAMBLE
 2. HOW TO INSTALL
 3. HOW TO USE
 4. BROWSER COMMANDS (includes instructions for how to update)
 5. FILES INCLUDED IN THIS PACKAGE
 6. SIGNATURE FORMAT
 7. KNOWN COMPATIBILITY PROBLEMS
 
                                  ~ ~ ~                                        
 
 
 1. PRE-RAMBLE
 
  Special thanks to ClamAV for both project inspiration and for the signatures 
  that this script utilises, without which, the script would likely not exist, 
  or at best, would have very limited value. <http://www.clamav.net/lang/en/>  

                                  ~ ~ ~                                        
 This script is free software; you can redistribute it and/or modify it under  
 the terms of the GNU General Public License as published by the Free Software 
 Foundation; either version 2 of the License, or (at your option) any later    
 version. This script is distributed in the hope that it will be useful, but   
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or 
 FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 details. <http://www.gnu.org/licenses/> <http://opensource.org/licenses/>     
 
                                  ~ ~ ~                                        
 
 
 2. HOW TO INSTALL
 
 I hope to streamline this process by making an installer at some point in the
 not too distant future, but until then, follow these instructions to get
 phpMussel working on *most systems and CMS:
 
 1) By your reading this, I'm assuming you've already downloaded an archived
    copy of the script, decompressed its contents and have it sitting somewhere
    on your local machine. From here, you'll want to work out where on your
    host or CMS you want to place those contents. A directory such as
    /public_html/phpmussel/ or similar (though, it doesn't matter which you
    choose, so long as it's something secure and something you're happy with)
    will suffice. Before you begin uploading, read on..
    
 2) Open "phpmussel.php", look for the line beginning with "$vault=", and
    replace the string between the following quotation marks on that line
    with the exact true location of the "vault" directory of phpMussel.
    You'll have noticed such a directory in the archive you would've downloaded
    (unless you feel up to re-coding the whole script, you'll need to maintain
    the same file and directory structure as it was in the archive / when
    decompressed). This "vault" directory should be one directory level beyond
    the directory that the "phpmussel.php" file will exist in. Save file, close.
    
 3) (Optional; Strongly recommended for advanced users, but not recommended
    for beginners or for the inexperienced): Open "phpmussel.ini" (located
    inside "vault") - This file contains all the operational options available
    for phpMussel. Above each option should be a brief comment describing what
    it does and what it is for. Adjust these options as you see fit, as per
    whatever is appropriate for your particular setup. Save file, close.
    
 4) Upload the contents (phpMussel and its files) to the directory you'd decided
    on earlier (you don't need the readme.txt or change_log.txt files included,
    but, mostly, you should upload everything).
    
 5) CMHOD the "vault" directory to "777". The main directory storing the contents
    (the one you chose earlier), usually, can be left alone, but CHMOD status
    should be checked if you've had permissions issues in the past on your
    system (by default, should be something like "755").
    
 6) Next, you'll need to "hook" phpMussel to your system or CMS. There are
    several different ways in which you can "hook" scripts such as phpMussel to
    your system or CMS, but the easiest is to simply include the script at
    the beginning of a core file of your system or CMS (one that'll generally
    always be loaded when someone accesses any page across your website)
    using a require or include command.
    Usually, this'll be something stored in a directory such as "/includes",
    "/assets" or "/functions", and will often be named something like "init.php",
    "common_functions.php", "functions.php" or similar. You'll have to work out
    which file this is for your situation.
    To do this, insert the following line of code to the very beginning of that
    core file, replacing the string contained inside the quotation marks with
    the exact address of the "phpmussel.php" file (local address, not the HTTP
    address; will look similar to the vault address mentioned earlier).
    
    <?php require("/user_name/public_html/phpmussel/phpmussel.php"); ?>
    
    Save file, close, reupload.
    
 7) At this point, you're done! However, you should probably test it out to
    make sure it's working properly. To test out file upload protections,
    download one of our testing files and attempt to upload it to your
    website via your usual browser-based upload methods. If everything is
    working, a message should appear from phpMussel confirming that the upload
    was successfully blocked. If nothing appears, something isn't working
    correctly. If you're using any advanced features or if you're using the
    other types of scanning possible with the tool, I'd suggest trying it out
    to make sure it works as expected, too.
 
                                  ~ ~ ~                                        
 
 
 3. HOW TO USE
 
 phpMussel is intended to be a script which will function adequately right from
 the box with a bare minimum level of requirements on your part: Once it has
 been installed, basically, it simply should work.
 
 Scanning of file uploads is automated and enabled by default, so nothing is
 required on your behalf for this particular function.
 
 However, you are also able to instruct phpMussel to scan for files,
 directories or archives that you implicitly specify. To do this, firstly,
 you'll need to ensure that the appropriate configuration is set in the
 phpmussel.ini file (cleanup must be disabled), and once done, in a php file
 that is hooked to phpMussel, use the following function in your code:
 
 phpMussel($what_to_scan,$output_type,$output_flatness);
 
 Where:
 - $what_to_scan is either a string or an array, pointing to either a target
   file, a target directory or an array of target files and/or target
   directories. Omitting this variable will result in a "file does not exist"
   status being returned by the function.
 - $output_type is an integer, indicating the format in which the results of
   the scan are to be return as. A value of 0 instructs the function to return
   results as an integer (a returned result of -2 indicates that corrupt data
   was detected during the scan and thus the scan failed to complete,
   -1 indicates that extensions or addons required by php to execute the scan
   were missing and thus the scan failed to complete, 0 indicates that the
   scan target does not exist and thus there was nothing to scan,
   1 indicates that the target was successfully scanned and no problems were
   detected, and 2 indicates that the target was successfully scanned and
   problems were detected). A value of 1 instructs the function to return
   results as human readable text. A value of 2 instructs the function both
   to return the results as human readable text and to export the results to
   a global variable. This variable is optional, defaulting to 0.
 - $output_flatness is an integer, indicating whether to allow results to be
   returned as an array or not. Normally, if the scan target contained
   multiple items (such as if a directory or array) the results will be
   returned in an array (default value of 0). A value of 1 instructs the
   function to implode any such array prior to input, resulting in a flattened
   string containing the results to be returned. This variable is optional,
   defaulting to 0.
 
 Examples:
 
   $results=phpMussel("/user_name/public_html/my_file.html",1,1);
   echo $results;
 
   Returns something like this (as a string):
    Wed, 18 Sep 2013 02:49:46 +0000 Started.
    > Checking '/user_name/public_html/my_file.html':
    -> No problems found.
    Wed, 18 Sep 2013 02:49:47 +0000 Finished
 
 For a full break-down of what sort of signatures phpMussel uses during its
 scans and how it handles these signatures, refer to the Signature Format
 section of this README file.
 
 If you encounter any false positives, if you encounter something new that you
 think should be blocked, or for anything else regarding signatures, please
 contact me about it so that I may make the necessary changes, which, if you do
 not contact me, I may not necessarily be aware of.
 
 To disable signatures that are include with phpMussel (such as if you're
 experiencing a false positive specific to your purposes which should not
 normally be removed from streamline), refer to the Greylisting notes within
 the Browser Commands section of this README file.
 
 In addition to the default file upload scanning and the optional scanning
 of other files and/or directories specified via the above function, included
 in phpMussel is a function intended for scanning the body of email messages.
 This function behaves similarly to the standard phpMussel() function, but
 focuses solely on matching against the ClamAV email-based signatures.
 I have not tied these signatures into the standard phpMussel() function,
 because it is highly unlikely that you'd ever find the body of an incoming
 email message in need of scanning within a file upload targeted to a page
 where phpMussel is hooked, and thus, to tie these signatures into the
 phpMussel() function would be redundant. However, that said, having a
 separate function to match against these signatures could prove to be
 extremely useful for some, especially for those whose CMS or webfront system
 is somehow tied into their email system and for those of whom parse their
 emails via a php script of which they could potentially hook into phpMussel.
 Configuration for this function, like all others, is controlled via the
 phpmussel.ini file. To use this function (you'll need to do your own
 implementation), in a php file that is hooked to phpMussel, use the following
 function in your code:
 
 phpMussel_mail($body);
 
 Where $body is body of the email message you wish to scan (additionally, you
 could try scanning new forum posts, inbound messages from your online contact
 form or similar). If any error occurs preventing the function from completing
 its scan, a value of -1 will be returned. If the function completes its scan
 and does not match anything, a value of 0 will be returned (meaning clean).
 If, however, the function does match something, a string will be returned
 containing a message declaring what it has matched.
 
 In addition to the above, if you look at the source code, you may notice the
 function phpMusselD() and phpMusselR(). These functions are sub-functions of
 phpMussel(), and should not be called directly outside of that parent
 function (not because of adverse effects.. More-so, simply because it'd serve
 no purpose, and most probably won't actually work correctly anyhow).
 
 There are many other controls and functions available within phpMussel for
 your use, too. For any such controls and functions which, by the end of this
 section of the README, have not yet been documented, please continue reading
 and refer to the Browser Commands section of this README file.
 
                                  ~ ~ ~                                        
 
 
 4. BROWSER COMMANDS
 
 Once phpMussel has been installed and is correctly functioning on your system,
 if you've set the script_password and logs_password variables in your
 configuration file, you will be able to perform some limited number of
 administrative functions and input some number of commands to phpMussel via
 your browser. The reason these passwords need to be set in order to enable
 these browser-side controls is both to ensure proper security, proper
 protection of these browser-side controls and to ensure that there exists
 a way for these browser-side controls to be entirely disabled if they are not
 desired by you and/or other webmasters/administrators using phpMussel. So,
 in other words, to enable these controls, set a pasword, and to disable these
 controls, set no password. Alternatively, if you choose to enable these
 controls and then choose to disable these controls at a later date, there is
 a command to do this (such can be useful if you perform some actions that
 you feel could potentially compromise the delegated passwords and need to
 quickly disable these controls without modifying your configuration file).
 
 A couple of reasons why you -should- enable these controls:
 - Provides a way to greylist signatures on-the-fly in instances such as
   when you discover a signature that is producing a false-positive while
   uploading files to your system and you don't have time to manually edit
   and reupload your greylist file.
 - Provides a way for you to allow someone other than yourself to control your
   copy of phpMussel without the implicit need to grant them access to FTP.
 - Provides a way to provide controlled access to your log files.
 - Provides an easy way to update phpMussel when updates are available.
 - Provides a way for you to monitor phpMussel when FTP access or other
   conventional access points for monitoring phpMussel are not available.
 
 A couple of reasons why you should -not- enable these controls:
 - Provides a vector for potential attackers and undesirables to determine
   whether you are using phpMussel or not (although, this could be both a
   reason for and a reason against, depending on perspective) by way of
   blindly sending commands to servers as a means to probe. On one hand, this
   could discourage attackers from targeting your system if they learn that you
   are using phpMussel, assuming that they are probing because their attack
   method is rendered ineffective as a result of using phpMussel. However, on
   the other hand, if some unforeseen and currently unknown exploit within
   phpMussel or a future version thereof comes to light, and if it could
   potentially provide an attack vector, a positive result from such probing
   could actually encourage attackers to target your system.
 - If your delegated passwords were ever compromised, unless changed, could
   provide a way for an attacker to bypass whatever signatures may be otherwise
   normally preventing their attacks from succeeding, or even potentially
   disable phpMussel altogether, thus providing a way to render the
   effectiveness of phpMussel moot.
 
 Either way, regardless of what you choose, the choice is ultimately yours. By
 default, these controls will be disabled, but have a think about it, and if
 you decide you want them, this section explains both how to enable them and
 how to use them.
 
 A list of available browser-side commands:
 
 scan_log
   Password required: logs_password
   Other requirements: scan_log must be set.
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?logspword=[logs_password]&phpmussel=scan_log
   ~
   What it does: Prints the contents of your scan_log file to the screen.
   ~
 scan_kills
   Password required: logs_password
   Other requirements: scan_kills must be set.
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?logspword=[logs_password]&phpmussel=scan_kills
   ~
   What it does: Prints the contents of your scan_kills file to the screen.
   ~
 controls_lockout
   Password required: logs_password OR script_password
   Other requirements: (none)
   Required parameters: (none)
   Optional parameters: (none)
   Example 1: ?logspword=[logs_password]&phpmussel=controls_lockout
   Example 2: ?pword=[script_password]&phpmussel=controls_lockout
   ~
   What it does: Disables ("locks out") all browser-side controls. This should
                 be used if you suspect that either of your passwords have been
                 compromised (this can happen if you're using these controls
                 from a computer which is not secure or not trust).
                 controls_lockout works by creating a file, controls.lck, in
                 your vault, which phpMussel will check for before performing
                 any commands of any kind. Once this happens, to reenable
                 controls, you'll need to manually delete the controls.lck file
                 via FTP or similar. Can be called using either password.
   ~
 disable
   Password required: script_password
   Other requirements: (none)
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?pword=[script_password]&phpmussel=disable
   ~
   What it does: Disables phpMussel. This should be used if you're performing
                 any updates or changes to your system or if you're installing
                 any new software or modules to your system which either do or
                 potentially could trigger false positives. This should also be
                 used if you're having any problems with phpMussel but do not
                 wish to remove it from your system. Once this happens, to
                 reenable phpMussel, use "enable".
   ~
 enable
   Password required: script_password
   Other requirements: (none)
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?pword=[script_password]&phpmussel=enable
   ~
   What it does: Enables phpMussel. This should be used if you've previously
                 disabled phpMussel using "disable" and want to reenable it.
   ~
 update
   Password required: script_password
   Other requirements: update.dat and update.inc must exist.
   Required parameters: (none)
   Optional parameters: forcedupdate
   Example: ?pword=[script_password]&phpmussel=update&musselvar=forcedupdate
   ~
   What it does: Checks for updates to both phpMussel and its signatures. If
                 update checks succeed and updates are found, will attempt
                 to download and install these updates. If updates are checked
                 too quickly, update check will abort. If update checks fail,
                 update will abort. If optional parameter "forcedupdate" is
                 supplied, time of last update will be ignored and thus
                 update check will continue even if it is being checked "too
                 quickly", but will still abort if update check fails. Results
                 of the entire process are printed to the screen. I recommend
                 including the optional parameter "forcedupdate" if you're
                 manually triggering this control, but please do not use
                 "forcedupdate" if you're automating the process, such as via
                 cron or similar. I recommend checking at least once per month
                 to ensure your signatures and your copy of phpMussel are kept
                 up to-date (unless, of course, you're checking for updates
                 and installing them manually, which, I'd still recommend
                 doing at least one per month). Checking more than twice per
                 month is probably pointless, considering I'm (at the time of
                 writing this) working on this project by myself and I'm very
                 unlikely to be able to produce updates of any kind more
                 frequently than that (nor do I particularly want to for the
                 most part).
   ~
 greylist
   Password required: script_password
   Other requirements: (none)
   Required parameters: [Name of signature to be greylisted]
   Optional parameters: (none)
   Example: ?pword=[script_password]&phpmussel=greylist&musselvar=[Signature]
   ~
   What it does: Add a signature to the greylist.
   ~
 greylist_clear
   Password required: script_password
   Other requirements: (none)
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?pword=[script_password]&phpmussel=greylist_clear
   ~
   What it does: Clears the entire greylist.
   ~
 greylist_show
   Password required: script_password
   Other requirements: (none)
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?pword=[script_password]&phpmussel=greylist_show
   ~
   What it does: Prints the contents of the greylist to the screen.
   ~
 
                                  ~ ~ ~                                        
 
 
 5. FILES INCLUDED IN THIS PACKAGE
 
 The following is a list of all of the files that should have been included
 in the archived copy of this script when you downloaded it, any files that
 may be potentially created as a result of your using this script, along with
 a short description of what all these files are for. This version of this
 section of the README file was valid at release of v0.3 of phpMussel, but may
 not accurately reflect previous versions of phpMussel, and furthermore, may
 become outdated as new versions are released.
 
 /change_log.txt (Documentation, Included)
    A record of changes made to the script between different
    versions (not required for proper function of script).
    ~
 /phpmussel.php (Script, Included)
    phpMussel Loader file. Loads the main script, updater, etcetera.
    This is what you're supposed to be hooking into (essential)!
    ~
 /readme.txt (Documentation, Included)
    The README file (this file; you're currently reading it).
    ~
 /web.config (Other, Included)
    An ASP.NET configuration file (in this instance, to protect the "/vault"
    directory from being accessed by non-authorised sources in the event that
    the script is installed on a server based upon ASP.NET technologies).
    ~
 /vault/ (Directory)
    Vault directory (contains various files).
    ~
 /vault/.htaccess (Other, Included)
    A hypertext access file (in this instance, to protect sensitive files
    belonging to the script from being accessed by non-authorised sources).
    ~
 /vault/elf_clamav_regex.cvd (Signatures, Included)
 /vault/elf_clamav_regex.map (Signatures, Included)
 /vault/elf_clamav_standard.cvd (Signatures, Included)
 /vault/elf_clamav_standard.map (Signatures, Included)
 /vault/elf_custom_regex.cvd (Signatures, Included)
 /vault/elf_custom_standard.cvd (Signatures, Included)
 /vault/elf_mussel_regex.cvd (Signatures, Included)
 /vault/elf_mussel_standard.cvd (Signatures, Included)
    Files for ELF signatures.
    Required if ELF signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/exe_clamav_regex.cvd (Signatures, Included)
 /vault/exe_clamav_regex.map (Signatures, Included)
 /vault/exe_clamav_standard.cvd (Signatures, Included)
 /vault/exe_clamav_standard.map (Signatures, Included)
 /vault/exe_custom_regex.cvd (Signatures, Included)
 /vault/exe_custom_standard.cvd (Signatures, Included)
 /vault/exe_mussel_regex.cvd (Signatures, Included)
 /vault/exe_mussel_standard.cvd (Signatures, Included)
    Files for Portable Executable file (EXE) signatures.
    Required if EXE signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/filenames_clamav.cvd (Signatures, Included)
 /vault/filenames_custom.cvd (Signatures, Included)
 /vault/filenames_mussel.cvd (Signatures, Included)
    Files for filename signatures.
    Required if filename signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/general_clamav_regex.cvd (Signatures, Included)
 /vault/general_clamav_regex.map (Signatures, Included)
 /vault/general_clamav_standard.cvd (Signatures, Included)
 /vault/general_clamav_standard.map (Signatures, Included)
 /vault/general_custom_regex.cvd (Signatures, Included)
 /vault/general_custom_standard.cvd (Signatures, Included)
 /vault/general_mussel_regex.cvd (Signatures, Included)
 /vault/general_mussel_standard.cvd (Signatures, Included)
    Files for general signatures.
    Required if general signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/graphics_clamav_regex.cvd (Signatures, Included)
 /vault/graphics_clamav_regex.map (Signatures, Included)
 /vault/graphics_clamav_standard.cvd (Signatures, Included)
 /vault/graphics_clamav_standard.map (Signatures, Included)
 /vault/graphics_custom_regex.cvd (Signatures, Included)
 /vault/graphics_custom_standard.cvd (Signatures, Included)
 /vault/graphics_mussel_regex.cvd (Signatures, Included)
 /vault/graphics_mussel_standard.cvd (Signatures, Included)
    Files for graphics signatures.
    Required if graphics signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/greylist.csv (Signatures, Included/Created)
    CSV of greylisted signatures indicating to phpMussel which signatures it
    should be ignoring (file automatically recreated if deleted).
    ~
 /vault/hex_general_commands.csv (Signatures, Included)
    Hex-encoded CSV of general command detections optionally used by phpMussel.
    Required if general command detection option in phpmussel.ini is enabled.
    Can remove if option is disabled (but file will be recreated on update).
    ~
 /vault/macho_clamav_regex.cvd (Signatures, Included)
 /vault/macho_clamav_regex.map (Signatures, Included)
 /vault/macho_clamav_standard.cvd (Signatures, Included)
 /vault/macho_clamav_standard.map (Signatures, Included)
 /vault/macho_custom_regex.cvd (Signatures, Included)
 /vault/macho_custom_standard.cvd (Signatures, Included)
 /vault/macho_mussel_regex.cvd (Signatures, Included)
 /vault/macho_mussel_standard.cvd (Signatures, Included)
    Files for Mach-O signatures.
    Required if Mach-O signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/mail_clamav_regex.cvd (Signatures, Included)
 /vault/mail_clamav_regex.map (Signatures, Included)
 /vault/mail_clamav_standard.cvd (Signatures, Included)
 /vault/mail_clamav_standard.map (Signatures, Included)
 /vault/mail_custom_regex.cvd (Signatures, Included)
 /vault/mail_custom_standard.cvd (Signatures, Included)
 /vault/mail_mussel_regex.cvd (Signatures, Included)
 /vault/mail_mussel_standard.cvd (Signatures, Included)
    Files for signatures used by the phpMussel_mail() function.
    Required if the phpMussel_mail() function is used in any way.
    Can remove if it is not used (but files will be recreated on update).
    ~
 /vault/md5_clamav.cvd (Signatures, Included)
 /vault/md5_custom.cvd (Signatures, Included)
 /vault/md5_mussel.cvd (Signatures, Included)
    Files for MD5 based signatures.
    Required if MD5 based signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/phpmussel.inc (Script, Included)
    phpMussel Core Script; The main body and guts of phpMussel (essential)!
    ~
 /vault/phpmussel.ini (Other, Included)
    phpMussel Configuration file; Contains all the configuration options of
    phpMussel, telling it what to do and how to operate correctly (essential)!
    ~
 /vault/scan_log.txt *(Logfile, Created)
    A record of everything scanned by phpMussel.
    ~
 /vault/scan_kills.txt *(Logfile, Created)
    A record of every file upload blocked/killed by phpMussel.
    ~
 /vault/template.html (Other, Included)
    phpMussel Template file; Template for HTML output produced by phpMussel for
    its blocked file upload message (the message seen by the uploader).
    ~
 /vault/update.dat (Other, Included)
    File containing version information for both the phpMussel script and the
    phpMussel signatures. If you ever want to automatically update phpMussel
    or want to update phpMusel via your browser, this file is essential.
    ~
 /vault/update.inc (Script, Included)
    phpMussel Update Script; Required for automatic updates and for updating
    phpMussel via your browser, but not required otherwise.
    ~
 /vault/zip_metadata_clamav.cvd (Signatures, Included)
 /vault/zip_metadata_custom.cvd (Signatures, Included)
 /vault/zip_metadata_mussel.cvd (Signatures, Included)
    Files for archive metadata signatures.
    Required if archive metadata signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 
 * Filename may differ based on configuration stipulations (in phpmussel.ini).
 
 = REGARDING SIGNATURE FILES =
    CVD is an acronym for "ClamAV Virus Definitions", in reference both to
    how ClamAV refers to its own signatures and to the use of those signatures
    for phpMussel; Files ending with "CVD" contain signatures.
    ~
    Files ending with "MAP", quite literally, map which signatures phpMussel
    should and shoudln't use for individual scans; Not all signatures are
    necessarily required for every single scan, so, phpMussel uses maps of
    the signature files to speed up the scanning process (a process which would
    otherwise be extremely slow and tedious).
    ~
    Signature files marked with "_regex" contain signatures which utilise
    regular expression pattern checking (regex).
    ~
    Signature files marked with "_standard" contain signatures which
    specifically do not utilise any form of pattern checking.
    ~
    Signature files marked with neither "_regex" nor "_standard" will be as
    one or the other, but not both (refer to the Signature Format section of
    this README file for documentation and specific details).
    ~
    Signature files marked with "_clamav" contain signatures that are sourced
    entirely from the ClamAV database (GNU/GPL).
    ~
    Signature files marked with "_custom", by default, do not contain any
    signature at all; These such files exist to give you somewhere to place
    your own custom signatures, if you come up with any of your own.
    ~
    Signature files marked with "_mussel" contain signatures that specifically
    are not sourced from ClamAV, signatures which, generally, I've either come
    up with myself and/or based on information gathered from various sources.
    belonging to the script from being accessed by non-authorised sources).
    ~
 
                                  ~ ~ ~                                        
 
 
 6. SIGNATURE FORMAT
 
 = MD5 SIGNATURES =
   All MD5 signatures follow the format:
    HASH:FILESIZE:NAME
   Where HASH is the MD5 hash of an entire file, FILESIZE is the total size
   of that file and NAME is the name to cite for that signature.
 
 = FILENAME SIGNATURES =
   All filename signatures follow the format:
    NAME:FNRX
   Where NAME is the name to cite for that signature and FNRX is the regex
   pattern to match filenames (unencoded) against.
 
 = ARCHIVE METADATA SIGNATURES =
   All archive metadata signatures follow the format:
    NAME:FILESIZE:CRC32
   Where NAME is the name to cite for that signature, FILESIZE is the total
   size (uncompressed) of a file contained within the archive and CRC32 is
   the crc32 checksum of that contained file.
 
 = EVERYTHING ELSE =
   All other signatures follow the format:
    NAME:HEX
   Where NAME is the name to cite for that signature and HEX is a
   hexidecimal-encoded segment of the file intended to be matched by
   the given signature.
 
 = REGEX =
   Any form of regex understood and correctly processed by php should also be
   correctly understood and processed by phpMussel and its signatures.
   However, I'd suggest taking extreme caution when writing new regex based
   signatures, because, if you're not entirely sure what you're doing, there
   can be highly irregular and/or unexpected results. Take a look at the
   phpMussel source-code if you're not entirely sure about the context in
   which regex statements are parsed. Also, remember that all patterns (with
   exception to filename, archive metadata and MD5 patterns) must be
   hexidecimally encoded (foregoing pattern syntax, of course)!
 
 = WHERE TO PUT CUSTOM SIGNATURES? =
   Only put custom signatures in those files intended for custom signatures.
   Those files should contain "_custom" in their filenames.
   You should also avoid editing the default signature files, unless you know
   exactly what you're doing, because, aside from being good practise in
   general and aside from helping you distinguish between your own signatures
   and the default signatures included with phpMussel, it is good to stick to
   editing only the files intended for editing, because tampering with the
   default signature files can cause them to stop working correctly, due to the
   "maps" files: The maps files tell phpMussel where in the signature files to
   look for signatures required by phpMussel as per when required, and these
   maps can become out-of-sync with their associated signature files if those
   signature files are tampered with. You can put pretty much whatever you want
   into your custom signatures, so long as you follow the correct syntax.
   However, be careful to test new signatures for false-positives beforehand
   if you intend to share them or use them in a live environment.
 
 = SIGNATURE BREAKDOWN =
   The following is a breakdown of the types of signatures used by phpMussel:
   - "MD5 Signatures" (md5_*). Checked against the MD5 hash of the contents
      and the filesize of every non-whitelisted file targeted for scanning.
   - "General Signatures" (general_*). Checked against the contents of every
     non-whitelisted file targeted for scanning.
   - "General Commands" (hex_general_commands.csv). Checked against the
     contents of every non-whitelisted file targeted for scanning.
   - "Portable Executable Signatures" (exe_*). Checked against the contents of
     every non-whitelisted targeted for scanning and matched to the PE format.
   - "ELF Signatures" (elf_*). Checked against the contents of every
     non-whitelisted file targeted for scanning and matched to the ELF format.
   - "Graphics Signatures" (graphics_*). Checked against the contents of every
     non-whitelisted file targeted for scanning and matched to a known
     graphical file format.
   - "Mach-O Signatures" (macho_*). Checked against the contents of every
     non-whitelisted file targeted for scanning and matched to the Mach-O
     format.
   - "ZIP MetaData Signatures" (zip_metadata_*). Checked against the CRC32
      hash and filesize of the initial file contained inside of any
      non-whitelisted archive targeted for scanning.
   - "Email Signatures" (mail_*). Checked against the $body variable parsed
     to the phpMussel_mail() function, which is intended to be the body of
     email messages or similar entities (potentially forum posts and etcetera).
   (Note that any of these signatures may be easily disabled via phpmussel.ini
    if you so desire).
 
                                  ~ ~ ~                                        
 
 
 7. KNOWN COMPATIBILITY PROBLEMS
 
 This section will describe known compatibility problems that phpMussel has.
 This section will change from time to time as new problems emerge and old
 problems cease.
 
 Avast! Anti-Virus
 - Not compatible with any current or previous version of phpMussel.
 - Not expected to be compatible with any future version of phpMussel.
 - One or more Avast signatures trigger a false positive for phpMussel,
   flagging it as a virus. Typical result is that phpMussel is instantly
   deleted from the system by Avast, without any available option to ignore or
   quaranteen. Reported event occurred at the archive level, immediately upon
   the reporter having downloaded phpMussel; No individual file testing has
   as of yet occurred.
 - Last checked 23rd October 2013 (latest version at time of writing: v0.3).
 
 
                                  ~ ~ ~                                        
 
 
EOF