      _____  _     _  _____  _______ _     _ _______ _______ _______   v0.1a   
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    
 Thank you for using phpMussel, a php-based script based upon ClamAV signatures
     designed to detect trojans, viruses, malware and etcetera within files    
             uploaded to your system wherever the script is hooked.            
                PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2                
 Please be aware, however, that this script (at least, at the time the version 
   you are currently using was released) is still UNDER CONSTRUCTION, NOT YET  
    COMPLETE, and thus comes with NO WARRANTY. Keep an eye out for updates.    
                                  ~ ~ ~                                        
 
 CONTENTS
 1. PRE-RAMBLE
 2. HOW TO INSTALL
 3. HOW TO USE
 4. FILES INCLUDED IN THIS PACKAGE
   (Yes, this is short, I know.. Will add more later.
    Intend to write updating, contribution and compatibility information.
    Project has only existed for a couple of days now.
    Within the next few updates, documentation should be more comprehensive).
 
                                  ~ ~ ~                                        
 
 
 1. PRE-RAMBLE
 
 < Excerpt from phpmussel.php >
 phpMussel version 0.1a (main script by Maikuolan, signatures by ClamAV).
 Last Updated (phpMussel, this version): 21st September 2013.
 
 Special thanks to ClamAV for both project inspiration and for the signature
 files that this script utilises, without which, the script would simply not
 exist, or at best, would have very limited value.
 Default signatures included with this version of phpMussel derived from
 mainlined signatures version 55 ("main.cvd"), released 17th September 2013.
 Both ClamAV and the latest copy of its (unmodified) signatures can be
 found at:
  http://www.clamav.net/lang/en/
 
 Special thanks to Zaphod and Spambot Security for giving the project a home
 via hosting and forums.
  http://www.spambotsecurity.com/forum/index.php
 
 Special thanks to all those supporting the project, and to you, for using
 the script.
 
 Also.. To anyone else that I should be mentioning that I haven't. I felt that
 I should probably include something like this (special thanks notice) in the
 script, but I don't have much experience and kind of suck at them, I'm not
 entirely sure what I should and shouldn't write here, so, whatever. Maybe I'll
 improve it with future versions or something. :)
 
 For help or support with the script (if you need it), you can find and contact
 me at Spambot Security or Game Jaunt.
  http://www.spambotsecurity.com/forum/memberlist.php?mode=viewprofile&u=516
  http://www.gamejaunt.com/contact.php
  http://www.gamejaunt.com/profile/Maikuolan/
 </ Excerpt from phpmussel.php >
 
 Script released as GNU/GPL V.2, which can be found (the license) at:
  http://www.gnu.org/licenses/licenses.html
 
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
	the beginning of a core file of your system of CMS (one that'll generally
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
 
 Scanning of file uploads is automated and enabled by default, so nothing is
 required on your behalf for this particular function. However, you are also
 able to instruct phpMussel to scan for files, directories or archives that
 you implicitly specify. To do this, firstly, you'll need to ensure that
 appropriate configuration is set phpmussel.ini file, and once done, to do
 this, in a php file that is hooked to phpMussel, use the following
 function in your code:
 
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
 
                                  ~ ~ ~                                        
 
 
 4. FILES INCLUDED IN THIS PACKAGE
 
 The following is a list of all of the files that should have been included
 in the archived copy of this script when you downloaded it, any files that
 may be potentially created as a result of your using this script, along with
 a short description of what all these files are for.
 
 /phpmussel.php - The main working file of the script (essential)!
 
 /change_log.txt - A record of changes made to the script between different
  versions (not required for proper function of script).
 
 /readme.txt - This readme.txt, of which you are currently reading (not
  required for proper function of script).
 
 /web.config - An ASP.NET configuration file (in this instance, to protect the
  "/vault" directory from being accesed by non-authorised sources in the event
  that the script is installed on a server based upon ASP.NET technologies).
 
 /vault/ - Vault directory, containing various required files.
 
 /vault/.htaccess - A hypertext access file (in this instance, to protect
  sensitive files belonging to the script from being accesed by non-authorised
  sources).
 
 /vault/basic.custom.cvd - For customised basic signatures for phpMussel to
  compare files against (uses ClamAV basic signatures format).
 
 /vault/basic.cvd - A copy of the ClamAV basic signatures for phpMussel to
  compare files again (modified for use by phpMussel).
 
 /vault/md5.custom.cvd - For customised MD5 signatures for phpMussel to compare
  files against (uses ClamAV MD5 signatures format).
 
 /vault/md5.cvd - A copy of the ClamAV MD5 signatures for phpMussel to compare
  files again (modified for use by phpMussel).
 
 ** /vault/extended.custom.cvd - For customised extended signatures for
  phpMussel to compare files against (uses ClamAV extended signatures format).
 
 ** /vault/extended.cvd - A copy of the ClamAV extended signatures for
  phpMussel to compare files again (modified for use by phpMussel).
 
 /vault/zip_metadata.custom.cvd - For customised ZIP MetaData signatures for
  phpMussel to compare files against (uses simplified variant of ClamAV ZIP
  MetaData signatures format).
 
 /vault/zip_metadata.cvd - A copy of the ClamAV ZIP MetaData signatures for
  phpMussel to compare files again (modified for use by phpMussel).
 
 /vault/hex_general_commands.csv - Hex-encoded CSV of recognised generalised
  command detections optionally used by phpMussel.
 
 /vault/phpmussel.ini - Contains all the configuration options of phpMussel,
  controlling how the script operates (essential).
 
 * /vault/scan_log.txt - The results of file scanning operations logged here.
 
 * /vault/scan_kills.txt - Upload kills logged here.
 
 /vault/template.html - Template file for the HTML output produced by phpMussel
  for its blocked file upload message.
 
 ** Not included in the current version of the script (planned to be included
    in a future version of the script).
 * Not included in the archive, but created by phpMussel as per when required.
   Also may be named differently from as per described here, pending phpMussel
   configuration (as per stipulated in phpmussel.ini).
 
                                  ~ ~ ~                                        
 
 
 EOF