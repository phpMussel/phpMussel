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
 * This file: Bangla language data for the front-end (last modified: 2018.07.12).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['Extended Description: phpMussel'] = 'প্রধান প্যাকেজ (স্বাক্ষর, ডকুমেন্টেশন এবং কনফিগারেশন সহ না)।';
$phpMussel['lang']['bNav_home_logout'] = '<a href="?">হোম পেজ</a> | <a href="?phpmussel-page=logout">প্রস্থান</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">প্রস্থান</a>';
$phpMussel['lang']['config_attack_specific_allow_leading_trailing_dots'] = 'ফাইলের নামগুলির মধ্যে শীর্ষস্থানীয় এবং অনুন্নত বিন্দুগুলির অনুমতি দিন? এটি কখনও কখনও ফাইলগুলি লুকাতে, অথবা কিছু সিস্টেমকে ট্রানসালাল ডাইরেক্ট করার অনুমতি দেওয়ার জন্য ব্যবহার করা যেতে পারে। False = অনুমতি দেবেন না [ডিফল্ট]। True = অনুমতি দিন।';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'পরিচিত আর্কাইভ ফাইল এক্সটেনশন (বিন্যাসে CSV হয়; সমস্যাগুলি ঘটলেই কেবল যুক্ত বা অপসারণ করা উচিত; অবাঞ্ছিতভাবে অপসারণ করা মিথ্যা ইতিবাচক প্রদর্শিত হতে পারে, এবং অকৃত্রিমভাবে যোগ করা হবে মূলত আপনি কি নির্দিষ্ট আক্রমণ থেকে যোগ করছেন কি হোয়াইটলিস্ট; সতর্কতা সঙ্গে সংশোধন করুন; এটিও লক্ষ্য করুন যে সামগ্রী-স্তরের আর্কাইভ বিশ্লেষণে এটির কোনো প্রভাব নেই)। মান অনুযায়ী, অধিকাংশ সিস্টেম এবং CMS- এ তালিকাটি সর্বাধিক ব্যবহৃত বিন্যাসে তালিকাভুক্ত করা হয়, কিন্তু এটি অপরিহার্যভাবে বিস্তৃত নয়।';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'কোনও নিয়ন্ত্রণ অক্ষর (নতুন লাইন ব্যতীত) ধারণকারী কোনও ফাইল অবরোধ করুন? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) যদি আপনি কেবলমাত্র প্লেইন-টেক্সট আপলোড করছেন, তাহলে আপনি আপনার সিস্টেমে কিছু অতিরিক্ত সুরক্ষা প্রদান করতে এই সক্ষম করতে পারেন। যাইহোক, যদি আপনি প্লেইন-টেক্সট ছাড়া অন্য কিছু আপলোড, এই সক্রিয় করার ফলে মিথ্যা ইতিবাচক হতে পারে। False = ব্লক করবেন না [ডিফল্ট]; True = ব্লক করুন।';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'এক্সিকিউটেবল করা হয় না বা আর্কাইভ হিসাবে স্বীকৃত নয় যে এক্সিকিউটেবল হেডারগুলিকে অনুসন্ধান করুন, এবং এক্সিকিউটেবলের জন্য অনুসন্ধান করুন যার শিরোনামগুলি ভুল। False = না; True = হাঁ।';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'PHP হেডার মধ্যে আছে ফাইল যে PHP ফাইল নয় বা স্বীকৃত আর্কাইভ নয় অনুসন্ধান করুন। False = না; True = হাঁ।';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'আর্কাইভগুলির জন্য অনুসন্ধান করুন যার শিরোনামগুলি ভুল (সমর্থিত: BZ, GZ, RAR, ZIP, RAR, GZ)। False = না; True = হাঁ।';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'অফিসের দস্তাবেজগুলির অনুসন্ধান করুন যার শিরোনামগুলি ভুল (সমর্থিত: DOC, DOT, PPS, PPT, XLA, XLS, WIZ)। False = না; True = হাঁ।';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'চিত্রগুলির জন্য অনুসন্ধান করুন যার শিরোনামগুলি ভুল (সমর্থিত: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP)। False = না; True = হাঁ।';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'PDF ফাইলগুলি অনুসন্ধান করুন যার শিরোনামগুলি ভুল। False = না; True = হাঁ।';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'দূষিত ফাইল এবং প্রক্রিয়াকরণ ত্রুটি। False = উপেক্ষা করা; True = ব্লক করুন [ডিফল্ট]। সম্ভাব্য দূষিত PE (পোর্টেবল এক্সেকিউটেবল) ফাইল সনাক্ত এবং ব্লক করুন? প্রায়ই (কিন্তু সবসময় না), যখন একটি PE ফাইলের অংশ দূষিত বা সঠিকভাবে প্রক্রিয়া করা যাবে না, এটি একটি ভাইরাস সংক্রমণের ইঙ্গিত হতে পারে। বেশিরভাগ অ্যান্টি-ভাইরাস প্রোগ্রামই PE ফাইলগুলির মধ্যে ভাইরাস সনাক্ত করতে নির্দিষ্ট প্রসেসগুলির প্রয়োজন, এবং যদি একটি ভাইরাস লেখক এটি সচেতন, তারা এটি প্রতিরোধ করার চেষ্টা করতে পারে, তাদের ভাইরাস অদৃশ্য থাকার অনুমতি দেয় যাতে।';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'কমান্ড ডিকোডের সর্বাধিক দৈর্ঘ্যের ডেটা সনাক্ত করা যেতে পারে (ক্ষেত্রে স্ক্যানিং সময় নজরদারির কার্যকারিতা সমস্যা)। ডিফল্ট = 512KB। জিরো সীমা অক্ষম করে (যখন 0, ফাইলের উপর ভিত্তি করে কোন সীমা থাকবে না)।';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'সর্বাধিক দৈনিক দৈর্ঘ্য যে phpMussel পড়তে ও স্ক্যান করতে অনুমোদিত (ক্ষেত্রে স্ক্যানিং সময় নজরদারির কার্যকারিতা সমস্যা)। ডিফল্ট = 32MB। জিরো সীমা অক্ষম করে। সাধারণত, এই মান ইনবাউন্ড ফাইলের গড় আকারের চেয়ে বড় হওয়া উচিত, "filesize_limit" নির্দেশের চেয়ে বেশি হতে হবে না, এবং PHP জন্য মোট অনুমোদিত মেমরি একটি পঞ্চমাংশ কম হওয়া উচিত। এই নির্দেশটি phpMussel খুব মেমরি আপ ব্যবহার থেকে প্রতিরোধ করার চেষ্টা বিদ্যমান (অত্যধিক মেমরি ব্যবহারের ফলে এটি কার্যকরভাবে স্ক্যানিং ফাইল থেকে প্রতিরোধ করতে পারে)।';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'সাধারণত এটি অক্ষম করা হয়, তবে আপনার সিস্টেমে phpMussel সঠিকভাবে কাজ করার জন্য কখনও কখনও প্রয়োজন হতে পারে। সাধারনত, যখন অক্ষম থাকে, phpMussel অ্যারের <code>$_FILES</code> উপাদানগুলির উপস্থিতি সনাক্ত করে, এবং এটি এমন ফাইলগুলিকে স্ক্যান করার চেষ্টা করবে যা ঐ উপাদানগুলির প্রতিনিধিত্ব করে, এবং, যদি ঐ উপাদানগুলি ফাঁকা থাকে, phpMussel একটি ত্রুটির বার্তাটি প্রত্যাবর্তন করবে। এই phpMussel জন্য সঠিক আচরণ। যাইহোক, কিছু CMS জন্য, খালি উপাদানের যারা CMS প্রাকৃতিক আচরণের ফলে হিসাবে ঘটতে পারে, বা ত্রুটিগুলি যখন কোনও না তখন রিপোর্ট করা হতে পারে, যে ক্ষেত্রে, phpMussel জন্য স্বাভাবিক আচরণ যারা CMS স্বাভাবিক আচরণ হস্তক্ষেপ করা হবে। যদি আপনার জন্য এই পরিস্থিতিটি ঘটে, এই বিকল্পটি সক্রিয় করা হলে phpMusselকে এই খালি উপাদানের পরীক্ষা করার চেষ্টা করবে না, যখন পাওয়া যায় এবং কোনও সম্পর্কিত ত্রুটির বার্তাগুলি ফেরত না দেওয়া হয় তখন তাদের উপেক্ষা করুন, এইভাবে পৃষ্ঠা অনুরোধ অবিরত করা অনুমতি দেয়। False = না; True = হাঁ।';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'আপনি যদি শুধুমাত্র আশা বা শুধুমাত্র আপনার সিস্টেম বা CMS আপলোড করা ইমেজ অনুমতি অভিপ্রায়, এবং যদি আপনি একেবারে অ-ইমেজ ফাইলগুলি আপনার সিস্টেমে বা CMS এ আপলোড করার প্রয়োজন হয় না, এই নির্দেশটি সক্ষম করা উচিত, কিন্তু অন্যথায় অক্ষম করা উচিত। যদি এই নির্দেশটি সক্রিয় থাকে, তবে এটি phpMusselকে অকেঞ্জিতভাবে অ-ইমেজ ফাইল হিসাবে সনাক্ত করা কোনও আপলোডগুলিকে ব্লক করার নির্দেশ দেবে, তাদের স্ক্যান না করেই। এটি অ-ইমেজ ফাইল আপলোডগুলির জন্য প্রক্রিয়াকরণ সময় এবং মেমরির ব্যবহারের পরিমাণ কমাতে পারে। False = না; True = হাঁ।';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'এনক্রিপ্ট করা আর্কাইভ সনাক্ত এবং ব্লক করুন? phpMussel এনক্রিপ্ট আর্কাইভের বিষয়বস্তু স্ক্যান করতে সক্ষম নয়, এবং তাই, এটা সম্ভব যে আর্কাইভ এনক্রিপশন একটি আক্রমণকারী দ্বারা phpMussel, অ্যান্টি-ভাইরাস স্ক্যানার এবং অন্যান্য যেমন সুরক্ষা এড়ানো উপায় হিসাবে নিয়োগ করা হতে পারে। phpMussel এনক্রিপটেড আর্কাইভ ব্লক করতে বলার ফলে এই ঝুঁকি হ্রাস করতে পারে। False = না; True = হাঁ [ডিফল্ট]।';
$phpMussel['lang']['config_files_check_archives'] = 'আর্কাইভের বিষয়বস্তু পরীক্ষা করার চেষ্টা? False = চেক করবেন না; True = চেক করুন [ডিফল্ট]। বর্তমানে, সমর্থন শুধুমাত্র আর্কাইভ এবং কম্প্রেশন বিন্যাস BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR এবং ZIP হয় (আর্কাইভ এবং কম্প্রেশন বিন্যাস RAR, CAB, 7z এবং ইত্যাদি বর্তমানে সমর্থিত নয়)। এটা বুলেটপ্রুফ নয়! আমি অত্যন্ত সক্ষম এটি রাখার সুপারিশ, কিন্তু আমি এটা সব সবসময় পাবেন এটি গ্যারান্টি না করতে পারেন। এছাড়াও সচেতন থাকুন যে আর্কাইভ পরীক্ষণ বর্তমানে PHARগুলি বা ZIPগুলি এর জন্য পুনরাবৃত্তি নয়।';
$phpMussel['lang']['config_files_filesize_archives'] = 'আর্কাইভের বিষয়বস্তুতে ফাইলের আকার কালো তালিকা এবং সাদা তালিকা চালিয়ে যান? False = না (ধূসর তালিকায় সবকিছু); True = হাঁ [ডিফল্ট]।';
$phpMussel['lang']['config_files_filesize_limit'] = 'ফাইলের আকার সীমা KB তে। 65536 = 64MB [ডিফল্ট]; 0 = সীমাহীন (ধূসর তালিকায় সবকিছু)। কোন ইতিবাচক সাংখ্যিক মান গ্রহণ। আপনার PHP কনফিগারেশন মেমরি পরিমাণ একটি প্রক্রিয়া ধরে রাখতে পারে যখন সীমিত যখন এটা দরকারী হতে পারে অথবা যদি আপনার PHP কনফিগারেশন ফাইল আপলোডের আকার সীমিত করে।';
$phpMussel['lang']['config_files_filesize_response'] = 'ফাইল সীমা অতিক্রম যা ফাইলের সাথে কি করতে (যদি এক বিদ্যমান)? False = সাদা তালিকা করো; True = কালো তালিকা করো [ডিফল্ট]।';
$phpMussel['lang']['config_files_filetype_archives'] = 'আর্কাইভের বিষয়বস্তুতে ফাইলের ধরন কালো তালিকা এবং সাদা তালিকা চালিয়ে যান? False = না (ধূসর তালিকায় সবকিছু) [ডিফল্ট]; True = হাঁ।';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'কালো তালিকা:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'ধূসর তালিকা:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'যদি আপনার সিস্টেম কেবল নির্দিষ্ট ধরনের ফাইল আপলোড করতে দেয় তবে, অথবা যদি আপনার সিস্টেম স্পষ্টভাবে নির্দিষ্ট ধরনের ফাইলগুলি অস্বীকার করে, সাদা তালিকাগুলি, কালো তালিকাগুলি এবং ধূসর তালিকাগুলি মধ্যে ফাইলের প্রকার উল্লেখ করে স্ক্যান গতি বৃদ্ধি করতে পারে, স্ক্রিপ্ট নির্দিষ্ট ধরনের ফাইল উপেক্ষা করার অনুমতি দিয়ে। বিন্যাসটি CSV (কমা দ্বারা পৃথক করা মান)। যদি আপনি সবকিছু স্ক্যান করতে চান, এই তালিকাগুলি খালি রাখা যাক; তাই করা তাদের নিষ্ক্রিয় হবে, এবং সবকিছু স্ক্যান করা হবে। প্রক্রিয়াকরণের লজিক্যাল অর্ডার: এটি যদি সাদা তালিকা উপর, ফাইল স্ক্যান বা ব্লক করবেন না, এবং কালো তালিকা বা ধূসর তালিকা বিরুদ্ধে ফাইলটি পরীক্ষা করবেন না। এটি যদি কালো তালিকা উপর, ফাইলটি স্ক্যান করবেন না কিন্তু এটি যেকোনোভাবে ব্লক করুন, এবং ধূসর তালিকা বিরুদ্ধে ফাইল চেক করবেন না। এটি যদি ধূসর তালিকা উপর, বা ধূসর তালিকা খালি হলে, স্বাভাবিক হিসাবে ফাইল স্ক্যান এবং স্ক্যানের ফলাফলগুলির উপর ভিত্তি করে এটি ব্লক করা হবে কিনা তা নির্ধারণ করে, কিন্তু এটি যদি ধূসর তালিকা উপর না এবং ধূসর তালিকা খালি নয়, কালো তালিকা মতো ফাইলটি ব্যবহার করুন, তাই এটি স্ক্যান করা হয় না কিন্তু এটি অবরুদ্ধ রাখুন। সাদা তালিকা:';
$phpMussel['lang']['config_files_max_recursion'] = 'আর্কাইভগুলির জন্য সর্বাধিক পুনরাবৃত্তি গভীরতা সীমা। ডিফল্ট = 10।';
$phpMussel['lang']['config_files_max_uploads'] = 'স্ক্যান বাতিলের আগে স্ক্যান করার জন্য সর্বাধিক অনুমোদিত ফাইল আপলোড (সীমা অতিক্রমকারী মানে ব্যবহারকারীদের একযোগে তারা খুব বেশী আপলোড করা হয় যে অবগত করা হবে)! একটি তাত্ত্বিক DDoS আক্রমণের বিরুদ্ধে সুরক্ষা প্রদান করে একই সময়ে খুব বেশি আপলোড করার কারণে। প্রস্তাবিত: 10। আপনি আপনার হার্ডওয়্যারের গতির উপর নির্ভর করে এই সংখ্যা বাড়াতে বা কম করতে পারেন। লক্ষ্য করুন যে এই সংখ্যাটি আর্কাইভের বিষয়বস্তুগুলির জন্য নয়।';
$phpMussel['lang']['config_general_FrontEndLog'] = 'ফ্রন্ট-এন্ড লগইন প্রচেষ্টা রেকর্ড করার জন্য ফাইল। ফাইলের নাম উল্লেখ করুন, অথবা নিষ্ক্রিয় করতে ফাঁকা রাখুন।';
$phpMussel['lang']['config_general_allow_symlinks'] = 'কখনও কখনও phpMussel এটি একটি নির্দিষ্ট ভাবে নামকরণ করা হয় যখন সরাসরি একটি ফাইল অ্যাক্সেস করতে পারবেন না। পরোক্ষভাবে ফাইল অ্যাক্সেস মাধ্যমে symlinks কখনও কখনও এই সমস্যা সমাধান করতে পারেন। যাইহোক, এটি সবসময় একটি কার্যকর সমাধান হয় না, কারণ কিছু সিস্টেমে, symlinks ব্যবহার নিষিদ্ধ করা হতে পারে, অথবা প্রশাসনিক বিশেষাধিকার প্রয়োজন হতে পারে। এই নির্দেশটি ব্যবহার করা হয় কিনা তা নির্ধারণ করার জন্য phpMussel symlinks অদৃশ্যভাবে ফাইল অ্যাক্সেস করার চেষ্টা করা উচিত কিনা, যখন তাদের সরাসরি অ্যাক্সেস করা সম্ভব নয়। True = Symlinks সক্রিয় করুন; False = Symlinks অক্ষম করুন [ডিফল্ট]।';
$phpMussel['lang']['config_general_cleanup'] = 'আপলোড স্ক্যানিং শেষ হওয়ার পরে স্ক্রিপ্ট দ্বারা ব্যবহৃত সমস্ত ভেরিয়েবল এবং ক্যাশে ধ্বংস করে? False = না; True = হাঁ [ডিফল্ট]। আপলোড স্ক্যানিংয়ের জন্য যদি আপনি শুধুমাত্র স্ক্রিপ্টটি ব্যবহার করেন, আপনাকে <code>true</code> এ সেট করা উচিত, মেমরি ব্যবহার কমানোর জন্য। যদিও আপনি অন্য জিনিস করছেন, আপনাকে <code>false</code> এ সেট করা উচিত, ডুপ্লিকেট ডেটা মেমরিতে পুনরায় লোড করতে এড়ানোর জন্য। সাধারণ পদ্ধতিতে, এটি সাধারণত <code>true</code> হিসাবে সেট করা উচিত, কিন্তু যদি আপনি এটি করেন তবে আপনি কেবল আপলোড স্ক্যানিংয়ের জন্য স্ক্রিপ্ট ব্যবহার করতে পারবেন। CLI মোডে কোন প্রভাব নেই।';
$phpMussel['lang']['config_general_default_algo'] = 'সব ভবিষ্যত পাসওয়ার্ড এবং সেশন জন্য ব্যবহার করে অ্যালগরিদম সংজ্ঞায়িত করে। বিকল্প: PASSWORD_DEFAULT (ডিফল্ট), PASSWORD_BCRYPT, PASSWORD_ARGON2I (PHP &gt;= 7.2.0 প্রয়োজন)।';
$phpMussel['lang']['config_general_delete_on_sight'] = 'এই নির্দেশটি সক্ষম করা হলে, স্ক্রিপ্টকে অবিলম্বে স্ক্যান করা ফাইল আপলোডকে মুছে ফেলতে নির্দেশ দেওয়া হবে যা কোন সনাক্তকরণের মানদণ্ডের সাথে মেলে, কিনা স্বাক্ষর বা অন্যথায় মাধ্যমে। বিনয়ী পরিষ্কার/ফাইলগুলি স্পর্শ করা হবে না। আর্কাইভগুলির জন্য, সম্পূর্ণ আর্কাইভ মুছে ফেলা হবে, বিষয়বস্তুর নির্বিশেষে। স্বাভাবিক ফাইল আপলোড স্ক্যানিংয়ের জন্য, এই নির্দেশকে সক্ষম করার জন্য এটি সাধারণত প্রয়োজন হয় না, কারণ PHP সাধারণত স্বয়ংক্রিয়ভাবে তার ক্যাশের বিষয়বস্তু সাফ করা যখন মৃত্যুদন্ড সমাপ্ত হয়েছে (অর্থাত এটি সাধারণত এই ফাইলগুলি মুছে ফেলবে; তারা ইতিমধ্যে কপি বা সরানো হয়েছে না অভিমানী)। এই নির্দেশটি নিরাপত্তা একটি অতিরিক্ত পরিমাপ হিসাবে এখানে যোগ করা হয় (পিএইচপি কিছু ব্যবহারকারীদের জন্য সাধারণত আচরণ না ক্ষেত্রে)। False = স্ক্যান করার পরে, একা ফাইলটি ছেড়ে দিন [ডিফল্ট]; True = স্ক্যান করার পরে, অবিলম্বে অশুচি ফাইল মুছে দিন।';
$phpMussel['lang']['config_general_disable_cli'] = 'CLI মোড অক্ষম? CLI মোড ডিফল্টরূপে সক্ষম করা হয়, কিন্তু কখনও কখনও নির্দিষ্ট পরীক্ষার সরঞ্জামগুলিতে (যেমন PHPUnit হিসাবে, উদাহরণস্বরূপ) এবং অন্যান্য CLI-ভিত্তিক অ্যাপ্লিকেশন হস্তক্ষেপ করতে পারে। যদি আপনি CLI মোড অক্ষম করতে না চান, তাহলে আপনাকে এই নির্দেশকে উপেক্ষা করা উচিত। False = CLI মোড সক্ষম করুন [ডিফল্ট]; True = CLI মোড অক্ষম করুন।';
$phpMussel['lang']['config_general_disable_frontend'] = 'ফ্রন্ট-এন্ড অ্যাক্সেস অক্ষম করুন? ফ্রন্ট-এন্ড অ্যাক্সেস phpMussel আরও পরিচালনযোগ্য করতে পারে, কিন্তু এটি একটি সম্ভাব্য নিরাপত্তার ঝুঁকিও হতে পারে। এটি সম্ভব হলে ব্যাক-এন্ডের মাধ্যমে phpMussel পরিচালনার জন্য সুপারিশ করা হয়, তবে সুবিধার জন্য ফ্রন্ট-এন্ড অ্যাক্সেসও প্রদান করা হয়। যদি এটির প্রয়োজন হয় না তবে এটি অক্ষম রাখুন। False = ফ্রন্ট-এন্ড অ্যাক্সেস সক্ষম করুন; True = ফ্রন্ট-এন্ড অ্যাক্সেস অক্ষম করুন [ডিফল্ট]।';
$phpMussel['lang']['config_general_disable_webfonts'] = 'ওয়েবফটগুলি অক্ষম করবেন? True = হাঁ [ডিফল্ট]; False = না।';
$phpMussel['lang']['config_general_enable_plugins'] = 'phpMussel প্লাগইনগুলির জন্য সমর্থন সক্ষম করবেন? False = না; True = হাঁ [ডিফল্ট]।';
$phpMussel['lang']['config_general_forbid_on_block'] = 'phpMussel ফাইল আপলোড ব্লক বার্তা সঙ্গে 403 হেডার পাঠাতে হবে, বা শুধু স্বাভাবিক 200 OK পাঠাতে? False = না (200); True = হাঁ (403) [ডিফল্ট]।';
$phpMussel['lang']['config_general_honeypot_mode'] = 'Honeypot মোড সক্ষম করা হলে, phpMussel সমস্ত ফাইল আপলোড সঙ্গরোধ চেষ্টা করবে, নির্বিশেষে এটি কোনো অন্তর্ভুক্ত স্বাক্ষর মেলে কিনা, এবং কোন স্ক্যানিং বা বিশ্লেষণ আসলে ঘটবে। এই কার্যকারিতা ম্যালওয়্যার গবেষণা জন্য দরকারী হওয়া উচিত, কিন্তু এই কার্যকারিতা সক্রিয় করা স্বাভাবিক অবস্থার অধীনে সুপারিশ করা হয় না। সাধারণত, এই বিকল্পটি অক্ষম করা আছে। False = অক্ষম করা থাকে; True = সক্ষম করা থাকে [ডিফল্ট]।';
$phpMussel['lang']['config_general_ipaddr'] = 'ইনবাউন্ড অনুরোধের আইপি ঠিকানা কোথায় পাওয়া যায়? (যেমন Cloudflare এবং ইত্যাদি সেবা জন্য দরকারী)। ডিফল্ট = REMOTE_ADDR। সতর্কতা: আপনি কি করছেন তা না জানলে তা পরিবর্তন করবেন না!';
$phpMussel['lang']['config_general_lang'] = 'phpMussel এর জন্য ডিফল্ট ভাষা নির্দিষ্ট করুন।';
$phpMussel['lang']['config_general_log_rotation_action'] = 'লগ আবর্তন যে কোন এক সময়ে উপস্থিত থাকা লগ ফাইলর সংখ্যা সীমাবদ্ধ করে। যখন নতুন লগ ফাইলগুলি তৈরি করা হয়, লগ ফাইলের মোট সংখ্যা নির্দিষ্ট সীমা অতিক্রম করে, তখন নির্দিষ্ট অ্যাকশনটি সঞ্চালিত হবে। আপনি এখানে পছন্দসই কর্ম উল্লেখ করতে পারেন। Delete = সীমা অতিক্রম না হওয়া পর্যন্ত, প্রাচীনতম লগ ফাইলগুলি মুছুন। Archive = প্রথমত, লগ ফাইলগুলিকে আর্কাইভ করুন, এবং তারপর, সীমা অতিক্রম না হওয়া পর্যন্ত, প্রাচীনতম লগ ফাইলগুলি মুছুন।';
$phpMussel['lang']['config_general_log_rotation_limit'] = 'লগ আবর্তন যে কোন এক সময়ে উপস্থিত থাকা লগ ফাইলর সংখ্যা সীমাবদ্ধ করে। যখন নতুন লগ ফাইলগুলি তৈরি করা হয়, লগ ফাইলের মোট সংখ্যা নির্দিষ্ট সীমা অতিক্রম করে, তখন নির্দিষ্ট অ্যাকশনটি সঞ্চালিত হবে। আপনি এখানে পছন্দসই সীমা নির্ধারণ করতে পারেন। 0 এর মান লগ আবর্তন নিষ্ক্রিয় করবে।';
$phpMussel['lang']['config_general_maintenance_mode'] = 'রক্ষণাবেক্ষণ মোড সক্ষম করবেন? True = হাঁ; False = না [ডিফল্ট]। ফ্রন্ট-এন্ড ছাড়া অন্য সব কিছু অক্ষম করে। আপনার CMS, ফ্রেমওয়ার্ক, ইত্যাদি আপডেট করার সময় কখনও কখনও দরকারী।';
$phpMussel['lang']['config_general_max_login_attempts'] = 'লগইন প্রচেষ্টা সর্বাধিক সংখ্যা। ডিফল্ট = 5।';
$phpMussel['lang']['config_general_numbers'] = 'কিভাবে সংখ্যা প্রদর্শন করা উচিত? উদাহরণটি নির্বাচন করুন যা আপনার কাছে সবচেয়ে সঠিক দেখায়।';
$phpMussel['lang']['config_general_quarantine_key'] = 'যদি আপনি চান, phpMussel ভল্টের মধ্যে আপলোড আলাদা করতে পারেন। আপলোডের বিশদ বিশ্লেষণে আগ্রহী নই এমন ব্যবহারকারীদের এই কার্যকারিতা অক্ষম করা উচিত। ব্যবহারকারীরা গভীর বিশ্লেষণে আগ্রহী, বা ম্যালওয়্যার গবেষণা আগ্রহী, এই কার্যকারিতা সক্রিয় করা উচিত। এটি কখনও কখনও ডিবাগিংয়ের সাথে সহায়তা করতে পারে। এটি নিষ্ক্রিয় করার জন্য, <code>quarantine_key</code> নির্দেশিকা খালি রাখুন (অথবা প্রয়োজন হলে তা পরিষ্কার করুন)। এটি সক্ষম করতে, নির্দেশিকাতে কিছু মান প্রবেশ করান। <code>quarantine_key</code> একটি গুরুত্বপূর্ণ নিরাপত্তা বৈশিষ্ট্য (সম্ভাব্য হামলাকারীদের দ্বারা শোষিত হওয়ার কার্যকারিতা থেকে এটি প্রতিরোধ করা প্রয়োজন)। <code>quarantine_key</code> হিসাবে আপনার পাসওয়ার্ড হিসাবে একই ভাবে চিকিত্সা করা উচিত: দীর্ঘতর ভাল হয়, এবং এটি শক্তভাবে পাহারা। সেরা প্রভাবের জন্য, <code>delete_on_sight</code> এর সাথে ব্যবহার করুন।';
$phpMussel['lang']['config_general_quarantine_max_files'] = 'সংগ্রাহক মধ্যে উপস্থিত হতে পারে ফাইলের সর্বাধিক সংখ্যা। যখন নতুন ফাইল সংযোজনে যোগ করা হয়, যদি এই নম্বরটি অতিক্রম করা হয়, তাহলে পুরানো ফাইল মুছে ফেলা হবে না যতক্ষন বাকি অবশিষ্ট এই সংখ্যাটি অতিক্রম করে না। ডিফল্ট = 100।';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'সংগ্রাহক মধ্যে স্থাপন করা সর্বাধিক ফাইলের আকার অনুমোদিত। নির্দিষ্ট মান তুলনায় বড় ফাইল সংযোজনে করা হবে না। সম্ভাব্য আক্রমণকারীদের থামানোর জন্য এই নির্দেশটি গুরুত্বপূর্ণ (অবাঞ্ছিত তথ্য দিয়ে বন্যা ঝুঁকি কারণে)। ডিফল্ট = 2MB।';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'সর্বাধিক মেমরি ব্যবহারের জন্য সংগ্রাহক অনুমোদিত। যদি কনভার্টাইন দ্বারা ব্যবহৃত মোট মেমরিটি এই মানটিতে পৌঁছে যায়, তাহলে সম্পূর্ণরূপে ব্যবহৃত হওয়া মেমরিটি এই মানটি পর্যন্ত পৌঁছানো না হওয়া পর্যন্ত পুরানো সর্বাধিক ফাইলগুলি মুছে ফেলা হবে। অবাঞ্ছিত তথ্য দিয়ে আপনার কনরন্টাইন বন্যা আক্রমণকারীদের প্রতিরোধ করতে সাহায্য করার জন্য এই নির্দেশটি গুরুত্বপূর্ণ। ডিফল্ট = 64MB।';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'স্ক্যানিংয়ের ফলাফল কতক্ষণ phpMussel ক্যাশে রাখতে হবে? স্ক্যানটি স্ক্যানিংয়ের ফলাফল ক্যাশে করার মান হল সেকেন্ডের সংখ্যা। ডিফল্ট 21600 সেকেন্ড হয় (6 ঘন্টা); 0 এর মান স্ক্যানিংয়ের ফলাফল ক্যাশিং অক্ষম করবে।';
$phpMussel['lang']['config_general_scan_kills'] = 'ব্লক বা হত্যা আপলোড সমস্ত রেকর্ড লগ জন্য ফাইলের নাম। ফাইলের নাম উল্লেখ করুন, অথবা নিষ্ক্রিয় করতে ফাঁকা রাখুন।';
$phpMussel['lang']['config_general_scan_log'] = 'সব স্ক্যানিং ফলাফল লগ করার জন্য ফাইলের নাম। ফাইলের নাম উল্লেখ করুন, অথবা নিষ্ক্রিয় করতে ফাঁকা রাখুন।';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'সব স্ক্যানিং ফলাফল লগ করার জন্য ফাইলের নাম (একটি সিরিয়ালিত বিন্যাস ব্যবহার করে)। ফাইলের নাম উল্লেখ করুন, অথবা নিষ্ক্রিয় করতে ফাঁকা রাখুন।';
$phpMussel['lang']['config_general_statistics'] = 'phpMussel ব্যবহারের পরিসংখ্যান ট্র্যাক? True = হাঁ; False = না [ডিফল্ট]।';
$phpMussel['lang']['config_general_timeFormat'] = 'phpMussel দ্বারা ব্যবহৃত তারিখ/সময় উল্লেখ ফরম্যাট। অনুরোধ উপর অতিরিক্ত বিকল্প যোগ করা যেতে পারে।';
$phpMussel['lang']['config_general_timeOffset'] = 'টাইমজোন মিনিটে অফসেট।';
$phpMussel['lang']['config_general_timezone'] = 'আপনার টাইমজোন।';
$phpMussel['lang']['config_general_truncate'] = 'একটি নির্দিষ্ট আকার পৌঁছানোর সময় লগ ফাইলগুলি কেটে ফেলা হবে? মানটি B/KB/MB/GB/TB-এ সর্বোচ্চ আকারের হয় যা একটি লকফিলি ছাঁটাই হওয়ার পূর্বে বাড়তে পারে। 0KB এর ডিফল্ট মান truncation নিষ্ক্রিয় (logfiles অনির্দিষ্টভাবে বৃদ্ধি করতে পারেন)। নোট: এই একবচন লগফাইল প্রয়োগ করা হয়! লগফাইল আকার সম্মিলিতভাবে গণ্য করা হয় না।';
$phpMussel['lang']['config_heuristic_threshold'] = 'কিছু স্বাক্ষরগুলি ফাইলগুলির সন্দেহজনক এবং সম্ভাব্য ক্ষতিকারক গুণাবলীগুলি চিহ্নিত করার উদ্দেশ্যে তৈরি করা হয়েছে, যা তাদের ফাইলগুলিকে তাদের নিজস্ব অধিকারে দূষিত হিসাবে সনাক্ত না করেই আপলোড করা যায়। এই মান phpMussel কিভাবে এই গুণগুলি নির্ণয় করতে হয়, এবং সর্বাধিক ওজন যতক্ষণ না দূষিত হিসাবে চিহ্নিত করা যায় আগে অনুমতি দেওয়া হয়। এই পরিপ্রেক্ষিতে, ওজন সংজ্ঞা সনাক্ত করা সন্দেহজনক এবং সম্ভাব্য দূষিত গুণাবলী মোট সংখ্যা। সাধারনত, এই মান 3 সেট করা হবে। একটি নিম্ন মান সাধারণত মিথ্যা ইতিবাচক একটি উচ্চ সংঘটন ফলাফল কিন্তু একটি দূষিত ফাইলের উচ্চ নম্বর চিহ্নিত করা হবে। একটি উচ্চ মান সাধারণত মিথ্যা ইতিবাচক একটি নিম্ন ঘটতে হবে কিন্তু নিম্ন সংখ্যক দূষিত ফাইল চিহ্নিত করা। এটির সাথে সম্পর্কিত সমস্যার সম্মুখীন না হওয়া পর্যন্ত এই মানটি ডিফল্টরূপে ছেড়ে দেওয়া সাধারণত ভাল।';
$phpMussel['lang']['config_legal_privacy_policy'] = 'কোন প্রযোজ্য পৃষ্ঠাগুলির পাদলেখ প্রদর্শিত একটি প্রাসঙ্গিক গোপনীয়তা নীতির ঠিকানা। একটি URL উল্লেখ করুন, বা অক্ষম করতে ফাঁকা রাখুন।';
$phpMussel['lang']['config_legal_pseudonymise_ip_addresses'] = 'লগ লেখার সময় IP ঠিকানাগুলি pseudonymize? True = হাঁ; False = না [ডিফল্ট]।';
$phpMussel['lang']['config_signatures_Active'] = 'কমা দ্বারা পৃথক করা সক্রিয় স্বাক্ষর ফাইলগুলির একটি তালিকা।';
$phpMussel['lang']['config_signatures_detect_adware'] = 'অ্যাডওয়্যারের সনাক্তকরণের জন্য phpMussel প্রক্রিয়া স্বাক্ষর করা উচিত? False = না; True = হাঁ [ডিফল্ট]।';
$phpMussel['lang']['config_signatures_detect_deface'] = 'ডিফ্লেসমেন্ট এবং ডিফেকারস সনাক্ত করার জন্য phpMussel প্রক্রিয়া স্বাক্ষর করা উচিত? False = না; True = হাঁ [ডিফল্ট]।';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'phpMussel এনক্রিপ্ট ফাইল সনাক্ত এবং ব্লক করা উচিত? False = না; True = হাঁ [ডিফল্ট]।';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'মজাদার/হ্যাক ম্যালওয়্যার/ভাইরাস সনাক্ত করার জন্য phpMussel প্রক্রিয়া স্বাক্ষর করা উচিত? False = না; True = হাঁ [ডিফল্ট]।';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'প্যাকার এবং প্যাকড ডেটা সনাক্ত করার জন্য phpMussel প্রক্রিয়া স্বাক্ষর করা উচিত? False = না; True = হাঁ [ডিফল্ট]।';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'PUAগুলি/PUPগুলি সনাক্ত করার জন্য phpMussel প্রক্রিয়া স্বাক্ষর করা উচিত? False = না; True = হাঁ [ডিফল্ট]।';
$phpMussel['lang']['config_signatures_detect_shell'] = 'শেল স্ক্রিপ্ট সনাক্ত করার জন্য phpMussel প্রক্রিয়া স্বাক্ষর করা উচিত? False = না; True = হাঁ [ডিফল্ট]।';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'এক্সটেনশনগুলি অনুপস্থিত যখন phpMussel রিপোর্ট করা উচিত? যদি <code>fail_extensions_silently</code> অক্ষম করা, স্ক্যান করার সময় অনুপস্থিত এক্সটেনশনগুলি প্রতিবেদন করা হবে। যদি <code>fail_extensions_silently</code> সক্ষম করা থাকে, তবে অনুপস্থিত এক্সটেনশনগুলি উপেক্ষা করা হবে এবং এটি প্রতিবেদন করা হবে যে স্ক্যান করা ফাইলগুলির সাথে কোনো সমস্যা নেই। এই নির্দেশটি অক্ষম করলে সম্ভবত আপনার নিরাপত্তা বৃদ্ধি পাবে, কিন্তু মিথ্যা ধনাত্মক বৃদ্ধি পেতে পারে। False = অক্ষম করা থাকে; True = সক্ষম করা থাকে [ডিফল্ট]।';
$phpMussel['lang']['config_signatures_fail_silently'] = 'স্বাক্ষর ফাইলগুলি অনুপস্থিত বা দূষিত হলে phpMussel প্রতিবেদন করা উচিত? স্ক্যান করা হলে <code>fail_silently</code> অক্ষম, অনুপস্থিত এবং দূষিত ফাইলগুলির প্রতিবেদন করা হবে। যদি <code>fail_silently</code> সক্ষম করা থাকে, অনুপস্থিত এবং দূষিত ফাইলগুলি উপেক্ষা করা হবে এবং এটি রিপোর্ট করা হবে যে কোন সমস্যা নেই। আপনি ক্র্যাশ বা অনুরূপ সমস্যার সম্মুখীন না হওয়া পর্যন্ত এই একা থাকা উচিত। False = অক্ষম করা থাকে; True = সক্ষম করা থাকে [ডিফল্ট]।';
$phpMussel['lang']['config_template_data_Magnification'] = 'ফন্ট বৃহত্তরীকরণ। ডিফল্ট = 1।';
$phpMussel['lang']['config_template_data_css_url'] = 'কাস্টম থিমগুলির জন্য CSS ফাইল URL।';
$phpMussel['lang']['config_template_data_theme'] = 'phpMussel এর জন্য ডিফল্ট থিম ব্যবহার করুন।';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'কতক্ষণ (সেকেন্ডে) API অনুসন্ধান ফলাফলের জন্য ক্যাশ করা উচিত? ডিফল্ট 3600 সেকেন্ড (1 ঘন্টা)।';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'যখন প্রয়োজনীয় API কী নির্ধারণ করা হয় তখন Google Safe Browsing API-এ নজরদারি সক্ষম করে।';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'যখন true সেট করা হয় তখন hpHosts API-এ সন্ধানগুলি সক্ষম করে।';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'প্রতি স্ক্যান চক্রের জন্য সর্বোচ্চ অনুমোদিত API অনুসন্ধান। প্রতিটি অতিরিক্ত API সন্ধান প্রতিটি স্ক্যান চক্রটি সম্পূর্ণ করার জন্য প্রয়োজনীয় মোট সময় যোগ করা হবে, তাই আপনি সামগ্রিক স্ক্যান প্রক্রিয়া দ্রুততর করার জন্য একটি সীমাবদ্ধতা নির্ধারিত করতে পারেন। 0 তে সেট করা হলে, কোন সীমা প্রয়োগ করা হবে না। সাধারণত 10 সেট করুন।';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'যদি অনুমতিপ্রাপ্ত API সার্ভারের সর্বাধিক সংখ্যা অতিক্রম করা হয় তবে কি করবেন? False = কিছু করনা (প্রসেসিং চালিয়ে) [ডিফল্ট]; True = ফাইলটি ব্লক করুন।';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'যদি আপনি চান, phpMussel Virus Total (ভাইরাস মোট) API ব্যবহার করে ফাইলগুলি স্ক্যান করতে পারে, যাতে ভাইরাস, ট্রোজান, ম্যালওয়ার এবং অন্যান্য হুমকিগুলির বিরুদ্ধে সুরক্ষা বৃদ্ধি পায়। সাধারণত, Virus Total (ভাইরাস মোট) API ব্যবহার করে স্ক্যান করা ফাইলগুলি অক্ষম করা আছে। এটি সক্রিয় করতে, Virus Total (ভাইরাস মোট) থেকে একটি API কী প্রয়োজন। এটি আপনাকে প্রদান করতে পারে এমন উল্লেখযোগ্য সুবিধার কারণে, এটি এমন কিছু বিষয় যা আমি অত্যন্ত সক্ষম করার সুপারিশ করছি। দয়া করে সচেতন হোন, যে Virus Total (ভাইরাস মোট) API ব্যবহার করার জন্য, আপনাকে তাদের পরিষেবার শর্তাদিতে সম্মত হতে হবে এবং আপনি Virus Total (ভাইরাস মোট) নথিপত্র দ্বারা বর্ণিত সমস্ত নির্দেশিকাগুলি মেনে চলবেন। আপনি পরিষেবার শর্তাবলীতে সম্মত না হওয়া পর্যন্ত এই ইন্টিগ্রেশন বৈশিষ্ট্যটি ব্যবহার করার অনুমতি নেই।';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'Virus Total (ভাইরাস মোট) API ডকুমেন্টেশন অনুযায়ী, এটি কোনো প্রদত্ত 1 মিনিটের সময় ফ্রেমে কোনও প্রকৃতির সর্বাধিক 4 টি অনুরোধে সীমাবদ্ধ। যদি আপনি একটি "honeyclient", "honeypot" চালান বা যে কোনও অটোমেশন VirusTotal এ সম্পদ সরবরাহ করতে যাচ্ছেন এবং শুধুমাত্র প্রতিবেদনগুলি পুনরুদ্ধার করবেন না, তাহলে আপনি উচ্চতর অনুরোধের হার কোটার আকারে পাবেন। ডিফল্টরূপে, phpMussel কঠোরভাবে এই সীমাবদ্ধতা মেনে চলবে, কিন্তু এই হার ক্যাটেগাসের সম্ভাবনা বৃদ্ধির কারণে, এই দুটি নির্দেশনা আপনাকে phpMusselকে নির্দেশ করার জন্য একটি মাধ্যম হিসেবে প্রদান করা হয়েছে যেটি কীভাবে মেনে চলতে হবে। যতক্ষণ না আপনি এটি করার নির্দেশ দিয়েছেন, ততক্ষণ আপনাকে এই মানগুলি বাড়ানোর জন্য সুপারিশ করা হয় না, কিন্তু যদি আপনি আপনার হার কোটাতে পৌঁছানোর সমস্যার সম্মুখীন হয়ে থাকেন তবে এই মানগুলি হ্রাস করতে কখনও কখনও আপনাকে এই সমস্যার মোকাবেলা করতে সাহায্য করতে পারে। আপনার হারের সীমা কোনো প্রদত্ত <code>vt_quota_time</code> মিনিটের সময় ফ্রেমের কোনও প্রকারের <code>vt_quota_rate</code> অনুরোধ হিসাবে নির্ধারণ করা হয়।';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(উপরের বিবরণ দেখুন)।';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'ডিফল্টরূপে, phpMussel এই ফাইলগুলিকে সীমাবদ্ধ করবে যেগুলি "সন্দেহজনক" হিসাবে বিবেচনা করে ফাইলগুলিকে ভাইরাস সর্বনিম্ন API ব্যবহার করে স্ক্যান করে। আপনি <code>vt_suspicion_level</code> নির্দেশের মান পরিবর্তন করে ঐচ্ছিকভাবে এই সীমাবদ্ধতাটি সামঞ্জস্য করতে পারেন।';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'Virus Total (ভাইরাস মোট) API থেকে স্ক্যান ফলাফলগুলি: phpMussel সনাক্তকরণ হিসাবে বা সনাক্তকরণ ওজন হিসাবে প্রয়োগ করা উচিত? একাধিক ইঞ্জিন ব্যবহার করে একটি ফাইল স্ক্যান করা (Virus Total (ভাইরাস মোট) এই আছে) একটি বর্ধিত সনাক্তকরণ হার ফলে উচিত (এবং তাই দূষিত ফাইল ধরা হচ্ছে একটি উচ্চ সংখ্যক), কিন্তু এটি মিথ্যা ইতিবাচক একটি উচ্চ সংখ্যক ফলে হতে পারে, এবং সেইজন্য, কিছু পরিস্থিতিতে, স্ক্যানিংয়ের ফলাফলগুলি একটি নিখুঁত উপসংহারের চেয়ে বরং আত্মবিশ্বাসের স্কোর হিসাবে ব্যবহার করা যেতে পারে (এবং সেই কারণেই এই নির্দেশটি বিদ্যমান)। যদি 0 একটি মান ব্যবহার করা হয়, যদি Virus Total (ভাইরাস মোট) পতাকা দ্বারা ব্যবহৃত কোন ফাইল দূষিত হিসাবে স্ক্যান করা হচ্ছে ফাইল, phpMussel ফাইলটি দূষিত হিসাবে বিবেচনা করবে। যদি অন্য কোনও মান ব্যবহার করা হয়, তাহলে Virus Total (ভাইরাস মোট) দ্বারা ব্যবহৃত ইঞ্জিনের সংখ্যা যা ফাইলটিকে দূষিত হিসাবে চিহ্নিত করে একটি আত্মবিশ্বাসের স্কোর হিসাবে পরিবেশন করবে (মান দূষিত হিসাবে বিবেচনা করা ফাইলের জন্য প্রয়োজনীয় সর্বনিম্ন আত্মবিশ্বাসের স্কোর প্রতিনিধিত্ব করবে)। 0 এর মান ডিফল্টরূপে ব্যবহৃত হয়।';
$phpMussel['lang']['confirm_action'] = 'আপনি কি "%s" চান?';
$phpMussel['lang']['field_activate'] = 'সক্রিয় করা';
$phpMussel['lang']['field_clear_all'] = 'সব পরিষ্কার করুন';
$phpMussel['lang']['field_component'] = 'কম্পোনেন্ট';
$phpMussel['lang']['field_create_new_account'] = 'নতুন অ্যাকাউন্ট তৈরি';
$phpMussel['lang']['field_deactivate'] = 'নিষ্ক্রিয় করা';
$phpMussel['lang']['field_delete_account'] = 'অ্যাকাউন্ট মুছে ফেলা';
$phpMussel['lang']['field_delete_all'] = 'মুছে সব';
$phpMussel['lang']['field_delete_file'] = 'মুছে ফেলা';
$phpMussel['lang']['field_download_file'] = 'ডাউনলোড';
$phpMussel['lang']['field_edit_file'] = 'সম্পাদন করা';
$phpMussel['lang']['field_false'] = 'False (মিথ্যা)';
$phpMussel['lang']['field_file'] = 'ফাইল';
$phpMussel['lang']['field_filename'] = 'ফাইলের নাম: ';
$phpMussel['lang']['field_filetype_directory'] = 'ডিরেক্টরি';
$phpMussel['lang']['field_filetype_info'] = '{EXT} ফাইল';
$phpMussel['lang']['field_filetype_unknown'] = 'অজানা';
$phpMussel['lang']['field_install'] = 'ইনস্টল করুন';
$phpMussel['lang']['field_latest_version'] = 'সবচেয়ে সাম্প্রতিক সংস্করণ';
$phpMussel['lang']['field_log_in'] = 'লগ ইন করুন';
$phpMussel['lang']['field_more_fields'] = 'আরও ক্ষেত্র';
$phpMussel['lang']['field_new_name'] = 'নতুন নাম:';
$phpMussel['lang']['field_ok'] = 'OK';
$phpMussel['lang']['field_options'] = 'বিকল্প';
$phpMussel['lang']['field_password'] = 'পাসওয়ার্ড';
$phpMussel['lang']['field_permissions'] = 'অনুমতিসমূহ';
$phpMussel['lang']['field_quarantine_key'] = 'সঙ্গরোধ চাবি';
$phpMussel['lang']['field_rename_file'] = 'পুনঃনামকরণ';
$phpMussel['lang']['field_reset'] = 'রিসেট';
$phpMussel['lang']['field_restore_file'] = 'পুনরুদ্ধার';
$phpMussel['lang']['field_set_new_password'] = 'নতুন পাসওয়ার্ড তৈরি করুন';
$phpMussel['lang']['field_size'] = 'মোট আকার: ';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_size_bytes'] = 'বাইট';
$phpMussel['lang']['field_status'] = 'অবস্থা';
$phpMussel['lang']['field_system_timezone'] = 'সিস্টেম ডিফল্ট টাইমজোন ব্যবহার করুন।';
$phpMussel['lang']['field_true'] = 'True (সত্য)';
$phpMussel['lang']['field_uninstall'] = 'আনইনস্টল করুন';
$phpMussel['lang']['field_update'] = 'আপডেট করুন';
$phpMussel['lang']['field_update_all'] = 'সব আপডেট করুন';
$phpMussel['lang']['field_upload_file'] = 'নতুন ফাইল আপলোড করুন';
$phpMussel['lang']['field_username'] = 'ব্যবহারকারীর নাম';
$phpMussel['lang']['field_verify'] = 'যাচাই করুন';
$phpMussel['lang']['field_verify_all'] = 'সব যাচাই করুন';
$phpMussel['lang']['field_your_version'] = 'আপনার সংস্করণ';
$phpMussel['lang']['header_login'] = 'চালিয়ে যেতে দয়া করে লগ ইন করুন।';
$phpMussel['lang']['label_active_config_file'] = 'সক্রিয় কনফিগারেশন ফাইল: ';
$phpMussel['lang']['label_actual'] = 'আসল';
$phpMussel['lang']['label_backup_location'] = 'সংগ্রহস্থল ব্যাকআপ অবস্থানগুলি (জরুরী ক্ষেত্রে, বা অন্য সব ব্যর্থ হলে):';
$phpMussel['lang']['label_blocked'] = 'আপলোডগুলি অবরুদ্ধ';
$phpMussel['lang']['label_branch'] = 'শাখা সর্বশেষ স্থিতিশীল:';
$phpMussel['lang']['label_clientinfo'] = 'ক্লায়েন্ট তথ্য:';
$phpMussel['lang']['label_events'] = 'স্ক্যান ঘটনা';
$phpMussel['lang']['label_expected'] = 'প্রত্যাশিত';
$phpMussel['lang']['label_expires'] = 'মেয়াদ শেষ: ';
$phpMussel['lang']['label_flagged'] = 'অবজেক্টস পতাকাঙ্কিত';
$phpMussel['lang']['label_fmgr_cache_data'] = 'ক্যাশ ডেটা এবং অস্থায়ী ফাইল';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'phpMussel ডিস্ক ব্যবহার: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'বিনামূল্যে ডিস্ক স্থান: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'মোট ডিস্ক ব্যবহার: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'মোট ডিস্ক স্থান: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'কম্পোনেন্ট আপডেট মেটাডেটা';
$phpMussel['lang']['label_hide'] = 'লুকান';
$phpMussel['lang']['label_hide_hash_table'] = 'হ্যাশ টেবিল লুকান';
$phpMussel['lang']['label_never'] = 'না';
$phpMussel['lang']['label_os'] = 'অপারেটিং সিস্টেম ব্যবহৃত:';
$phpMussel['lang']['label_other'] = 'অন্যান্য';
$phpMussel['lang']['label_other-Active'] = 'সক্রিয় স্বাক্ষর ফাইল';
$phpMussel['lang']['label_other-Since'] = 'শুরুর তারিখ';
$phpMussel['lang']['label_php'] = 'PHP সংস্করণ ব্যবহৃত:';
$phpMussel['lang']['label_phpmussel'] = 'phpMussel সংস্করণ ব্যবহৃত:';
$phpMussel['lang']['label_quarantined'] = 'আপলোডগুলি সঙ্গরোধ মধ্যে';
$phpMussel['lang']['label_sapi'] = 'SAPI ব্যবহৃত:';
$phpMussel['lang']['label_scanned_objects'] = 'অবজেক্টস স্ক্যান করা';
$phpMussel['lang']['label_scanned_uploads'] = 'আপলোডগুলি স্ক্যান করা';
$phpMussel['lang']['label_show'] = 'দেখাও';
$phpMussel['lang']['label_show_hash_table'] = 'হ্যাশ টেবিল দেখান';
$phpMussel['lang']['label_size_in_quarantine'] = 'সঙ্গরোধ আকার: ';
$phpMussel['lang']['label_stable'] = 'সর্বশেষ স্থিতিশীল:';
$phpMussel['lang']['label_sysinfo'] = 'সিস্টেম তথ্য:';
$phpMussel['lang']['label_tests'] = 'পরীক্ষাগুলি:';
$phpMussel['lang']['label_unstable'] = 'সর্বশেষ অস্থিতিশীল:';
$phpMussel['lang']['label_upload_date'] = 'আপলোড তারিখ: ';
$phpMussel['lang']['label_upload_hash'] = 'আপলোড হ্যাশ: ';
$phpMussel['lang']['label_upload_origin'] = 'আপলোড উত্স: ';
$phpMussel['lang']['label_upload_size'] = 'আপলোড আকার: ';
$phpMussel['lang']['label_your_ip'] = 'আপনার IP:';
$phpMussel['lang']['label_your_ua'] = 'আপনার UA:';
$phpMussel['lang']['link_accounts'] = 'অ্যাকাউন্ট';
$phpMussel['lang']['link_cache_data'] = 'ক্যাশ ডেটা';
$phpMussel['lang']['link_config'] = 'কনফিগারেশন';
$phpMussel['lang']['link_documentation'] = 'ডকুমেন্টেশনটি';
$phpMussel['lang']['link_file_manager'] = 'ফাইল ম্যানেজার';
$phpMussel['lang']['link_home'] = 'হোম পেজ';
$phpMussel['lang']['link_logs'] = 'লগ ফাইল';
$phpMussel['lang']['link_quarantine'] = 'সঙ্গরোধ';
$phpMussel['lang']['link_siginfo'] = 'স্বাক্ষর তথ্য';
$phpMussel['lang']['link_statistics'] = 'পরিসংখ্যান';
$phpMussel['lang']['link_textmode'] = 'পাঠ্য বিন্যাস: <a href="%1$sfalse">সহজ</a> – <a href="%1$strue">অভিনব</a>';
$phpMussel['lang']['link_updates'] = 'আপডেট';
$phpMussel['lang']['link_upload_test'] = 'আপলোড টেস্ট';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'নির্বাচিত লগ ফাইল বিদ্যমান নেই!';
$phpMussel['lang']['logs_no_logfile_selected'] = 'কোনও লগ ফাইল নির্বাচিত নেই।';
$phpMussel['lang']['logs_no_logfiles_available'] = 'কোন লগ ফাইল উপলব্ধ।';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'লগইন প্রচেষ্টা সর্বাধিক সংখ্যা অতিক্রম করেছে; প্রবেশাধিকার অস্বীকার।';
$phpMussel['lang']['previewer_days'] = 'দিন';
$phpMussel['lang']['previewer_hours'] = 'ঘন্টার';
$phpMussel['lang']['previewer_minutes'] = 'মিনিট';
$phpMussel['lang']['previewer_months'] = 'মাস';
$phpMussel['lang']['previewer_seconds'] = 'সেকেন্ড';
$phpMussel['lang']['previewer_weeks'] = 'সপ্তাহ';
$phpMussel['lang']['previewer_years'] = 'বছর';
$phpMussel['lang']['response_accounts_already_exists'] = 'এই ব্যবহারকারীর নামটি ইতিমধ্যেই বিদ্যমান রয়েছে!';
$phpMussel['lang']['response_accounts_created'] = 'অ্যাকাউন্ট সফলভাবে তৈরি!';
$phpMussel['lang']['response_accounts_deleted'] = 'অ্যাকাউন্ট সফলভাবে মোছা হয়েছে!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'সেই অ্যাকাউন্টটি বিদ্যমান নেই।';
$phpMussel['lang']['response_accounts_password_updated'] = 'পাসওয়ার্ড সফলভাবে আপডেট করা হয়েছে!';
$phpMussel['lang']['response_activated'] = 'সফলভাবে সক্রিয়।';
$phpMussel['lang']['response_activation_failed'] = 'সক্রিয় করতে ব্যর্থ হয়েছে!';
$phpMussel['lang']['response_checksum_error'] = 'চেকসাম ত্রুটি! ফাইল প্রত্যাখ্যাত!';
$phpMussel['lang']['response_component_successfully_installed'] = 'কম্পোনেন্ট সফলভাবে ইনস্টল।';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'কম্পোনেন্ট সফলভাবে আনইনস্টল।';
$phpMussel['lang']['response_component_successfully_updated'] = 'কম্পোনেন্ট সফলভাবে আপডেট।';
$phpMussel['lang']['response_component_uninstall_error'] = 'কম্পোনেন্ট আনইনস্টল করার চেষ্টা করার সময় একটি ত্রুটি ঘটেছে।';
$phpMussel['lang']['response_configuration_updated'] = 'কনফিগারেশন সফলভাবে আপডেট করা।';
$phpMussel['lang']['response_deactivated'] = 'সফলভাবে নিষ্ক্রিয়।';
$phpMussel['lang']['response_deactivation_failed'] = 'নিষ্ক্রিয় করতে ব্যর্থ হয়েছে!';
$phpMussel['lang']['response_delete_error'] = 'মুছে ফেলতে ব্যর্থ হয়েছে!';
$phpMussel['lang']['response_directory_deleted'] = 'ডিরেক্টরি সফলভাবে মুছে ফেলা!';
$phpMussel['lang']['response_directory_renamed'] = 'ডিরেক্টরি সফলভাবে পুনরায় নামকরণ করা হয়েছে!';
$phpMussel['lang']['response_error'] = 'ত্রুটি';
$phpMussel['lang']['response_failed_to_install'] = 'ইনস্টল করতে ব্যর্থ হয়েছে!';
$phpMussel['lang']['response_failed_to_update'] = 'আপডেট করতে ব্যর্থ হয়েছে!';
$phpMussel['lang']['response_file_deleted'] = 'ফাইল সফলভাবে মোছা হয়েছে!';
$phpMussel['lang']['response_file_edited'] = 'ফাইল সফলভাবে সম্পাদিত!';
$phpMussel['lang']['response_file_renamed'] = 'ফাইল সফলভাবে পুনরায় নামকরণ করা হয়েছে!';
$phpMussel['lang']['response_file_restored'] = 'ফাইল সফলভাবে পুনরুদ্ধার!';
$phpMussel['lang']['response_file_uploaded'] = 'ফাইল সফলভাবে আপলোড করা হয়েছে!';
$phpMussel['lang']['response_login_invalid_password'] = 'লগইন ব্যর্থতা! অবৈধ পাসওয়ার্ড!';
$phpMussel['lang']['response_login_invalid_username'] = 'লগইন ব্যর্থতা! ব্যবহারকারীর নাম অস্তিত্বহীন!';
$phpMussel['lang']['response_login_password_field_empty'] = 'পাসওয়ার্ড ক্ষেত্র খালি!';
$phpMussel['lang']['response_login_username_field_empty'] = 'ব্যবহারকারীর নাম ক্ষেত্র খালি!';
$phpMussel['lang']['response_login_wrong_endpoint'] = 'ভুল শেষপ্রান্ত!';
$phpMussel['lang']['response_possible_problem_found'] = 'সম্ভাব্য সমস্যা পাওয়া যায়।';
$phpMussel['lang']['response_rename_error'] = 'নামান্তর করতে ব্যর্থ!';
$phpMussel['lang']['response_restore_error_1'] = 'পুনরুদ্ধার করতে ব্যর্থ! দূষিত ফাইল!';
$phpMussel['lang']['response_restore_error_2'] = 'পুনরুদ্ধার করতে ব্যর্থ! ভুল সঙ্গরোধ চাবি!';
$phpMussel['lang']['response_sanity_1'] = 'ফাইলটিতে অপ্রত্যাশিত সামগ্রী রয়েছে! ফাইল প্রত্যাখ্যাত!';
$phpMussel['lang']['response_statistics_cleared'] = 'পরিসংখ্যান পরিস্কার।';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'ইতিমধ্যে আপ-টু-ডেট।';
$phpMussel['lang']['response_updates_not_installed'] = 'কম্পোনেন্ট ইনস্টল করা নেই!';
$phpMussel['lang']['response_updates_not_installed_php'] = 'কম্পোনেন্ট ইনস্টল করা নেই (PHP &gt;= {V} প্রয়োজন)!';
$phpMussel['lang']['response_updates_outdated'] = 'আউটডেটেড!';
$phpMussel['lang']['response_updates_outdated_manually'] = 'আউটডেটেড (দয়া করে ম্যানুয়ালি আপডেট করুন)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'আউটডেটেড (PHP &gt;= {V} প্রয়োজন)!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'নির্ধারণ করতে অক্ষম।';
$phpMussel['lang']['response_upload_error'] = 'আপলোড করতে ব্যর্থ!';
$phpMussel['lang']['response_verification_failed'] = 'যাচাইয়ের ব্যর্থ! কম্পোনেন্ট ভাঙ্গা হতে পারে।';
$phpMussel['lang']['response_verification_success'] = 'যাচাইয়ের সাফল্য! কোন সমস্যা খুঁজে পাওয়া যায় নি।';
$phpMussel['lang']['siginfo_key_CVE'] = 'স্বাক্ষর যে CVEগুলি (প্রচলিত দুর্বলতা এবং এক্সপোজারস) সঙ্গে মোকাবিলা।';
$phpMussel['lang']['siginfo_key_Chameleon'] = 'স্বাক্ষরগুলি "chameleon হামলার" মোকাবেলা করে।';
$phpMussel['lang']['siginfo_key_FN'] = 'স্বাক্ষর ফাইলের নামগুলির (ফাইলের বিষয়বস্তু বিরোধিতা হিসাবে) সাথে কাজ করে।';
$phpMussel['lang']['siginfo_key_Fake'] = 'ক্ষতিকারক এবং জাল সফ্টওয়্যার, স্ক্রিপ্ট, ইত্যাদি।';
$phpMussel['lang']['siginfo_key_HEUR'] = 'Heuristic তথ্য থেকে প্রাপ্ত স্বাক্ষর।';
$phpMussel['lang']['siginfo_key_META'] = 'স্বাক্ষর ফাইল মেটাডাটা (ফাইলের তথ্য বিপরীত হিসাবে) সাথে কাজ করে।';
$phpMussel['lang']['siginfo_key_Other'] = 'অজ্ঞাত বা অন্য।';
$phpMussel['lang']['siginfo_key_Other_Metadata'] = 'কোনও মেটাডেটা উপলব্ধ নেই।';
$phpMussel['lang']['siginfo_key_Suspect'] = 'সন্দেহজনক, কিন্তু নিশ্চিত না (বিভিন্ন শনাক্তকরণের সংমিশ্রণ জড়িত হতে পারে)।';
$phpMussel['lang']['siginfo_key_Testfile'] = 'পরীক্ষা ফাইলের জন্য স্বাক্ষর (দূষিত নয়)।';
$phpMussel['lang']['siginfo_key_Total'] = 'মোট সক্রিয় স্বাক্ষর।';
$phpMussel['lang']['siginfo_key_VT'] = 'সহ বা Virus Total থেকে তথ্য উপর ভিত্তি করে স্বাক্ষর।';
$phpMussel['lang']['siginfo_key_Werewolf'] = 'স্বাক্ষরগুলি "werewolf হামলার" মোকাবেলা করে।';
$phpMussel['lang']['siginfo_sub_Classes'] = 'স্বাক্ষর ফাইল ক্লাস দ্বারা গণনা';
$phpMussel['lang']['siginfo_sub_Files'] = 'স্বাক্ষর ফাইল দ্বারা গণনা';
$phpMussel['lang']['siginfo_sub_MalwareTypes'] = 'সংক্রমণ বা ম্যালওয়্যার টাইপ দ্বারা গণনা';
$phpMussel['lang']['siginfo_sub_SigTypes'] = 'স্বাক্ষর মেটাডেটা দ্বারা গণনা';
$phpMussel['lang']['siginfo_sub_Targets'] = 'লক্ষ্য ভেক্টর দ্বারা গণনা';
$phpMussel['lang']['siginfo_sub_Vendors'] = 'স্বাক্ষর বিক্রেতা বা উৎস দ্বারা গণনা';
$phpMussel['lang']['siginfo_xkey'] = '"%s" হিসাবে চিহ্নিত।';
$phpMussel['lang']['state_async_deny'] = 'অনুমতিগুলি অ্যাসিঙ্ক্রোনাস অনুরোধগুলি সঞ্চালনের পর্যাপ্ত নয়। আবার চেষ্টা করুন লগ ইন।';
$phpMussel['lang']['state_cache_is_empty'] = 'ক্যাশ খালি আছে।';
$phpMussel['lang']['state_complete_access'] = 'সম্পূর্ণ প্রবেশাধিকার';
$phpMussel['lang']['state_component_is_active'] = 'কম্পোনেন্ট সক্রিয়।';
$phpMussel['lang']['state_component_is_inactive'] = 'কম্পোনেন্ট নিষ্ক্রিয়।';
$phpMussel['lang']['state_component_is_provisional'] = 'কম্পোনেন্ট অস্থায়ী।';
$phpMussel['lang']['state_default_password'] = 'সতর্কতা: ডিফল্ট পাসওয়ার্ড ব্যবহার করে!';
$phpMussel['lang']['state_loading'] = 'লোড হচ্ছে ...';
$phpMussel['lang']['state_loadtime'] = 'পৃষ্ঠা অনুরোধ সম্পন্ন <span class="txtRd">%s</span> সেকেন্ড।';
$phpMussel['lang']['state_logged_in'] = 'লগ ইন আছে।';
$phpMussel['lang']['state_logs_access_only'] = 'লগ প্রবেশাধিকার শুধুমাত্র';
$phpMussel['lang']['state_maintenance_mode'] = 'সতর্কতা: রক্ষণাবেক্ষণ মোড সক্রিয় করা হয়!';
$phpMussel['lang']['state_password_not_valid'] = 'সতর্কতা: এই অ্যাকাউন্টটি একটি বৈধ পাসওয়ার্ড ব্যবহার করছে না!';
$phpMussel['lang']['state_quarantine'] = 'বর্তমানে সংগ্রাহক মধ্যে %s ফাইল আছে।';
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'অ-আউটডেটেড লুকান না';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'অ-আউটডেটেড লুকান';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'অব্যবহৃত লুকান না';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'অব্যবহৃত লুকান';
$phpMussel['lang']['tip_accounts'] = 'হ্যালো, {username}।<br />আপনি এই পৃষ্ঠাতে অ্যাকাউন্টগুলি তৈরি করতে, মুছে ফেলতে এবং সংশোধন করতে পারেন (phpMussel ফ্রন্ট-এন্ড কে প্রবেশাধিকার করতে পারে তা নির্ধারণ করে)।';
$phpMussel['lang']['tip_cache_data'] = 'হ্যালো, {username}।<br />এখানে আপনি ক্যাশের বিষয়বস্তু পর্যালোচনা করতে পারেন।';
$phpMussel['lang']['tip_config'] = 'হ্যালো, {username}।<br />আপনি এই পৃষ্ঠা থেকে phpMussel কনফিগারেশন পরিবর্তন করতে।';
$phpMussel['lang']['tip_donate'] = 'phpMussel বিনামূল্যে প্রদান করা হয়, কিন্তু যদি আপনি এই প্রকল্পের জন্য দান করতে চান, আপনি দান বোতাম ক্লিক করে তা করতে পারেন।';
$phpMussel['lang']['tip_fe_cookie_warning'] = 'নোট: লগইনগুলির প্রমাণীকরণের জন্য phpMussel একটি কুকি ব্যবহার করে। লগ ইন করে, আপনি আপনার ব্রাউজার দ্বারা তৈরি এবং সংরক্ষিত একটি কুকি জন্য আপনার অনুমতি দিন।';
$phpMussel['lang']['tip_file_manager'] = 'হ্যালো, {username}।<br />ফাইল ম্যানেজার ব্যবহার করে আপনি ফাইলগুলি মুছে, সম্পাদনা, আপলোড এবং ডাউনলোড করতে পারেন। সতর্কতার সাথে ব্যবহার করুন (আপনি এই সঙ্গে আপনার ইনস্টলেশন বিরতি হতে পারে)।';
$phpMussel['lang']['tip_home'] = 'হ্যালো, {username}।<br />এটা phpMussel ফ্রন্ট-এন্ড হোম পেজ হয়। চালিয়ে যেতে বাম দিকে নেভিগেশন মেনু থেকে একটি লিঙ্ক নির্বাচন করুন।';
$phpMussel['lang']['tip_login'] = 'ডিফল্ট ব্যবহারকারীর নাম: <span class="txtRd">admin</span> – ডিফল্ট পাসওয়ার্ড: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'হ্যালো, {username}।<br />যে লগ ফাইল এর বিষয়বস্তু দেখতে নীচের তালিকা থেকে একটি লগ ফাইল নির্বাচন করুন।';
$phpMussel['lang']['tip_quarantine'] = 'হ্যালো, {username}।<br />এই পৃষ্ঠাটি বর্তমানে সঙ্গরোধ মধ্যে সব ফাইল তালিকাভুক্ত এবং যারা ফাইল পরিচালনার সুবিধা।';
$phpMussel['lang']['tip_quarantine_disabled'] = 'নোট: সঙ্গরোধ বর্তমানে নিষ্ক্রিয়, কিন্তু কনফিগারেশন পৃষ্ঠার মাধ্যমে সক্ষম করা যেতে পারে।';
$phpMussel['lang']['tip_see_the_documentation'] = 'বিভিন্ন কনফিগারেশন নির্দেশাবলী এবং তাদের উদ্দেশ্য সম্পর্কে আরও তথ্যের জন্য <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.en.md#SECTION6">ডকুমেন্টেশনটি</a> দেখুন।';
$phpMussel['lang']['tip_siginfo'] = 'হ্যালো, {username}।<br />স্বাক্ষর তথ্য পৃষ্ঠা বর্তমানে সক্রিয় স্বাক্ষরগুলির সূত্র এবং প্রকারের বিষয়ে কিছু মৌলিক তথ্য সরবরাহ করে।';
$phpMussel['lang']['tip_statistics'] = 'হ্যালো, {username}।<br />এই পৃষ্ঠাটি আপনার phpMussel ইনস্টলেশনের সম্পর্কিত কিছু মৌলিক ব্যবহারের পরিসংখ্যান দেখায়।';
$phpMussel['lang']['tip_statistics_disabled'] = 'নোট: পরিসংখ্যান ট্র্যাকিং বর্তমানে অক্ষম আছে, তবে কনফিগারেশন পৃষ্ঠার মাধ্যমে সক্ষম করা যেতে পারে।';
$phpMussel['lang']['tip_updates'] = 'হ্যালো, {username}।<br />আপডেট পৃষ্ঠাটি আপনাকে phpMussel কম্পোনেন্ট ইনস্টল, আনইনস্টল এবং আপডেট করতে দেয় (কোর প্যাকেজ, স্বাক্ষর, L10N ফাইল, ইত্যাদি)।';
$phpMussel['lang']['tip_upload_test'] = 'হ্যালো, {username}।<br />আপলোড টেস্ট পৃষ্ঠাটিতে এটি একটি আপলোড করার চেষ্টা করার সময় একটি ফাইল সাধারণত phpMussel দ্বারা অবরুদ্ধ করা হবে কিনা পরীক্ষা করার জন্য একটি আদর্শ ফাইল আপলোড ফর্ম রয়েছে।';
$phpMussel['lang']['title_accounts'] = 'phpMussel – অ্যাকাউন্ট';
$phpMussel['lang']['title_cache_data'] = 'phpMussel – ক্যাশ ডেটা';
$phpMussel['lang']['title_config'] = 'phpMussel – কনফিগারেশন';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – ফাইল ম্যানেজার';
$phpMussel['lang']['title_home'] = 'phpMussel – হোম পেজ';
$phpMussel['lang']['title_login'] = 'phpMussel – লগ ইন';
$phpMussel['lang']['title_logs'] = 'phpMussel – লগ ফাইল';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – সঙ্গরোধ';
$phpMussel['lang']['title_siginfo'] = 'phpMussel – স্বাক্ষর তথ্য';
$phpMussel['lang']['title_statistics'] = 'phpMussel – পরিসংখ্যান';
$phpMussel['lang']['title_updates'] = 'phpMussel – আপডেট';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – আপলোড টেস্ট';
$phpMussel['lang']['warning'] = 'সতর্কবাণী:';
$phpMussel['lang']['warning_php_1'] = 'আপনার PHP সংস্করণ সক্রিয়ভাবে আর সমর্থিত হয় না! আপডেট করা হচ্ছে সুপারিশ!';
$phpMussel['lang']['warning_php_2'] = 'আপনার PHP সংস্করণ গুরুতরভাবে ঝুঁকিপূর্ণ! আপডেট করা অত্যন্ত দৃঢ়ভাবে সুপারিশ করা হয়!';
$phpMussel['lang']['warning_signatures_1'] = 'কোন স্বাক্ষর ফাইল সক্রিয় নেই!';

$phpMussel['lang']['info_some_useful_links'] = 'কিছু দরকারী লিঙ্ক:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">phpMussel সমর্থন @ GitHub</a> – phpMussel সমর্থন পৃষ্ঠা (সহায়তা, সহায়তা, ইত্যাদির জন্য)।</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – ওয়েবসাইটগুলি সুরক্ষিত করার জন্য সহজ ওয়েবমাস্টার সরঞ্জামগুলির একটি সংগ্রহ।</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – ClamAV হোমপেজে (ClamAV® ট্রোজান, ভাইরাস, ম্যালওয়্যার এবং অন্যান্য দূষিত হুমকি সনাক্ত করার জন্য একটি ওপেন সোর্স অ্যান্টিভাইরাস ইঞ্জিন।)।</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – কম্পিউটার নিরাপত্তা কোম্পানি ClamAV জন্য অনুপূরক স্বাক্ষর প্রস্তাব করে।</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – phpMussel URL স্ক্যানার দ্বারা ব্যবহৃত ফিশিং ডেটাবেস।</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group @ Facebook</a> – PHP লার্নিং সম্পদ এবং আলোচনা।</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP লার্নিং সম্পদ এবং আলোচনা।</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal সন্দেহজনক ফাইল এবং URLগুলি বিশ্লেষণ করার জন্য একটি বিনামূল্যে পরিষেবা।</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis (হাইব্রীড এনালাইসিস) একটি ফ্রি ম্যালওয়্যার বিশ্লেষণ পরিষেবা <a href="http://www.payload-security.com/">Payload Security (পেলোড সিকিউরিটি)</a> দ্বারা সরবরাহ করা হয়।</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – কম্পিউটার অ্যান্টি-ম্যালওয়্যার বিশেষজ্ঞরা।</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – ম্যালওয়ার উপর দৃষ্টি নিবদ্ধ করা দরকারী আলোচনা ফোরাম।</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Vulnerability Charts (দুর্বলতা চার্ট)</a> – বিভিন্ন প্যাকেজের নিরাপদ/অনিরাপদ সংস্করণের তালিকা (PHP, HHVM, ইত্যাদি)।</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Compatibility Charts (সামঞ্জস্যের চার্ট)</a> – বিভিন্ন প্যাকেজের জন্য সামঞ্জস্য তথ্য তালিকা (CIDRAM, phpMussel, ইত্যাদি)।</li>
        </ul>';
