MusicNet-Early
==============
This is an early version of the MusicNet Project : A social network for music enthusiasts. Semester long project for CS445: Information Systems, Spring 2014.

<h1>Members</h1>
<ul>
<li><strong>Chris (Owner of repo):</strong> Working on the front-end of the project. Everything you currently see on this repo was done by me. </li><br>
<li><strong>Ted:</strong> Database Testing and Optimization, as well as Documentation. WIll help with the frontend when DB is set.</li><br>
<li><strong>Piers:</strong> Database Parsing, Creation, Maintenance, and Optimization. Will help on frontend when DB is set.</li>
</ul>

<h1>INFO:</h1>
 
The database is currently being optimized, so there is not a lot in the way of functional code,
other than stylization. Once this has been completed appropriately, I can start making more complex queries. 
Some queries of varying complexity have taken 2+ minutes to return due to traffic on the Edlab servers, amongst other things. In addition, the Database and the Site (hosted on the same server) have often been going down for half a day at a time. This is out of our control and affects our development process.  


The code and styles are subject to change and are not currently final.

**NOTE:**
There are so many PHP files in the main directory as the php-wrapper that was written for our site (which we do not host) can only read PHP files from main directory. Thus is the reason for having to include CSS/JPG files awkwardly with PHP.

<h1>DAILY/WEEKLY GOALS</h1>
4/8-4/13: <del>(DB/site down 4/7)</del> <del>(DB/site down ~5:30PM on 4/9)</del>
<ul>
<li><del>Implement search algorithm [Initial Logic Implemented; Piers is going to try his hand at this]</del></li>
<li><del>Add Artist and Album pages</del></li>
<li><del>Authenticity Check for Artist, Album, Song pages</del></li>
<li>Implement "data drop" on Artist, Song, and Album pages</li>
<li><del>Database Optimization (Ted and Piers) [Behind due to DB being down 4/7 and 4/9]</del> </li>
<li><del>Finish Stylization of Profiles and </del>Complete Profile "data drop"</li>
</ul>
<strong>Little behind on this list due to the DB and site being down earlier in the week.</strong>

4/14-4/21:
<ul>
<li>Finish stylizing Song and add data</li>
<li>Finish Artist and Album pages based on Song's implementation</del>
<li>Add additional data to Profile</li>
<li>Stats Page</li>
<li>Recommendations Layout and algorithm</li>
<li>About Us Page</li>
</ul>

4/22-4/28: (DUE 4/29)
<ul>
<li>Finish Friend Page and Friend logic</li>
<li>Finish Playlist Page(profile) and playlist logic</del>
<li>Finish Playlist Page(main page) and playlist logic</li>
<li>Final Touches</li>
<li>Testing and Bug Fixes</li>
<li>

<h1>UPDATES:</h1>
4/5: 
<ul>
<li>Sign up page fields now correctly reflect database field; Page is complete.</li>
<li>adduser.php added to handle data from Sign up page for inserting to DB; highly incomplete</li>
<li>Login will correctly pass data to auth.php and will query database for user information</li>
<li>Username is stored as session variable for easy access in the user's profile page(s)</li>
<li>Profile page has been expanded and now all pages of the sidebar have been represented</li>
</ul>
4/6: 
<ul>
<li>Profile sidebar now appropriately highlights on respective pages</li>
<li>Added logic in adduser.php for adding users to DB from Login.php</li>
<li>Minor adjustments to Login.php to aid the processes in adduser.php</li>
<li>Profile navbar now appropriately highlights on respective pages</li>
<li>Splash now detects if user is logged on or not (determines placement of login options)</li>
<li>Added logout.php to allow users to log off.</li>
<li>Implemented Logout button on Splash.php (if logged in) and Profile (if logged in)</li>
<li>Resolved Session Conflicts on all pages?</li>
<li>Added logic to reach admin shell in bottombar.php</li>
<li>Removed navbarPlain.php as it was no longer being used</li>
<li>Added logic to destroy session if user is trying to sign up, but is already logged in</li>
<li>Updated the Profile Page styling; will finish later</li>
<li>Removed Singleton Profile. Many small changes made to reflect this on the profile pages</li>
<li>Added userCheck.php to make sure the profiles are real</li>
</ul>
4/7: 
<ul>
<li>Alerts have been rescripted from JavaScript to PHP</li>
<li>New User insertion to database appears to be working correctly and handles sessions appropriately</li>
<li>Readded navbarPlain.php as it was actually being used. </li>
<li>Added Search.php and have "enabled" searching from search bars </li>
<li>Profile design updated. Better reflects my envisioning of our profiles</li>
<li>Added refer.php so users can refer friends</li>
<li>Users are no longer redirected to splash if they are logged in and query for a fake user (now refer.php)</li>
<li>Refer.php moved onto profile page</li>
<li>Refer option added to sidebarProfile.php</li>
<li>checkUser.php now reroutes to refer.php with fake user's name (from querystring)</li>
<li>All profile pages check user name against DB (checkUser.php) to confirm authenticity</li>
</ul>
4/8:
<ul>
<li>Admin Shell for DB queries is available from the admin account</li>
<li>Updated the Querying Scripts to prevent SQL injections (?) </li>
<li>Added Scripts folder for non-paged scripts</li>
<li>Added initial logic for search page</li>
<li>Added Artist.php and Album.php pages</li>
<li>Added checkMusic.php to verfiy authenticity of Artist, Album, and Song pages</li>
</ul>
4/9:
<ul>
<li>Changes to Admin.php; Mostly Formatting of results</li>
<li>Spending the afternoon querying the DB for optimization purposes. (DB/site down ~5:30PM)</li>
<li>Stylized and added content to Splash.php so Ted can add site descriptions etc. </li>
<li>Stylized and added content to newuser.php so Ted can add site descriptions etc. </li>
<li>Splash and NewUser pages are complete </li>
<li>Code Beautification V1.0; most of the code looks good now :)</li>
</ul>
4/10:
<ul>
<li>Fixed some scaling and positioning issues on Splash.php and newuser.php </li>
<li>Profile.php is done with styling. Has some placeholder texts for when I add queries</li>
<li>Initial "data-drop" on Profile.php; other queries cannot be completed yet</li>
<li>Added fake music player and play count on Song.php (not final versions) </li>
</ul>
4/11:
<ul>
<li>Discover.php is done</li>
</ul>
4/13:
<ul>
<li>Search.php is implemented and complete. Minor bug in probability I will look into later</li>
<li>Added Recommend button to navbarProfile.php</li>
<li>Recommend.php added for recommendation pages</li>
<li>Refer.php is complete and sends email invites correctly</li>
</ul>
4/14:
<ul>
<li>Did some serious DB schema updates and optimizations</li>
</ul>
4/15-17:
<ul>
<li>MusicNet's on hold for a few days for some other pressing work and interviews</li>
</ul>

<h1>TO BE DONE: </h1>
<ul>
<li>Finish templating all pages and "data-drop" where need be, namely profile.php.</li>
<li><del>Implement full</del> Fix search alogrithm.</li>
<li>Add logic for Friend relations</li>
<li>Add logic for playlists</li>
<li><del>Add logic for discover (may be random if time does not permit for logic)</del></li>
<li>Add logic for recommendations</li>
</ul>
