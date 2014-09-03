MusicNet-Early
==============
This is an early version of the MusicNet Project : A social network for music enthusiasts. Semester long project for CS445: Information Systems, Spring 2014.

<h1> IMPORTANT INFORMATION </h1>
We are currently working on migrating our site to a permament server, as we were choosen as the best project by our peers and Professor. The new site url is http://avid.cs.umass.edu/projects/course-project/Musicnet/ . <del> A lot of the code is changing to facilate this migration, so not all pages are functional as of yet. In addition, the database is empty as of 5/18/14, but we will be working to get the site and database running in the next few days.</del> Site is up and running, but will not be updated in the future. 


<h1>Members</h1>
<ul>
<li><strong>Chris (Owner of repo):</strong> Frontend Developer/Code Monkey </li>
<ul>
<li>Currently working on bug fixes and optimizations for migration</li>
</ul>
<li><strong>Ted:</strong> Database Testing and Optimization, Frontend Testing,  as well as Documentation.</li>
<ul>
</ul>
<li><strong>Piers:</strong> Database Parsing, Creation, Maintenance, and Optimization. </li>
<ul>
<li>Going to bug test</li>
<li>Working on creating and loading data for new database on new server</li>
</ul>
</ul>


<h1>DAILY/WEEKLY GOALS</h1>
4/8-4/13: <del>(DB/site down 4/7)</del> <del>(DB/site down ~5:30PM on 4/9)</del>
<ul>
<li><del>Implement search algorithm [Initial Logic Implemented; Piers is going to try his hand at this]</del></li>
<li><del>Add Artist and Album pages</del></li>
<li><del>Authenticity Check for Artist, Album, Song pages</del></li>
<li><del>Implement "data drop" on Artist, Song, and Album pages</del></li>
<li><del>Database Optimization (Ted and Piers) [Behind due to DB being down 4/7 and 4/9]</del> </li>
<li><del>Finish Stylization of Profiles and </del>Complete Profile "data drop"</li>
</ul>
<strong>^Little behind on this list due to the DB and site being down earlier in the week.^</strong>

4/14-4/21:
<ul>
<li><del>Finish stylizing Song and add data and Finish AJAX stuff on Song</del></li>
<li><del>Finish Artist and Album pages based on Song's implementation</del></li>
<li><del>Add additional data to Profile</del></li>
<li><del>Stats Page</del></li>
<li><del>Recommendations Layout and algorithm</del></li>
<li><del>About Us Page (Ted's Working on it)</del></li>
<li><del>Optimize queries in Discover.php (running a bit slow)</del></li>
</ul>

4/22-4/28: (DUE 4/29)
<ul>
<li><del>Song Chat?</del></li>
<li><del>Finish Friend Page and Friend logic</del></li>
<li><del>Finish Playlist Page(profile) and playlist logic</del></li>
<li><del>Fix Admin Shell Output</del></li>
<li><del>Final Touches</del></li>
<li><del>Testing and Bug Fixes</del></li>
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
<del>
4/18-4/19</del>
<ul>
<li><del>Lots of progress on Song, including stylization, and AJAX to update user values etc. (Will commit 4/21)</del></li>
<li><del>Changed Alerts slightly; now employ JavaScript again (fixed previous JS issue) (Will commit 421)</del></li>
</ul>
4/21 (Large Commit from the Weekend)
<ul>
<li>Song.php is complete, minus the chat module</li>
 <ul>
  <li>Total Plays is updated when a song is "played" (DB and and on page using JS/AJAX)</li>
  <li>Rating is updated when changed/set (DB and on page using JS/AJAX)</li>
  <li>Average Rating is updated when rating is changed/set (DB and on page using JS/AJAX)</li>
  <li>Can add songs to playlists (handles no playlists and pre-existing playlists using JS/AJAX/PHP)</li>
  <li>Chat placeholder is present</li>
 </ul>
<li>Chat styling is done (functionality to be done later)</li>
<li>preexistingPlaylist.php added to handle user choice of playlists (for adding a song from song.php)</li>
<li>updates.js and update.php added to handle all updates (DB and AJAX) from song.php</li>
<li>Album.php and Artist.php are done</li>
<li>About.php is done</li>
<li>Changed Alerts slightly; now employ JavaScript again (fixed previous JS issue) </li>
</ul>
4/22:
<ul>
<li>Profile Songs, Playlists, and Friends are done. </li>
<li>addFriend.php added for friending</li>
<li>Updated update.php for adding playlists from profile</li>
<li>The Michael Rosen Lounge added</li>
</ul>

4/23: SPOTIFY COMMIT
<ul>
<li>Spotify has been integrated in song.php </li>
<ul>
<li>Queries spotify based on Song title and Artist with parsing</li>
<li>Displays our player if not found on Spotify</li>
<li>For Spotify player, play counter is incremented on page load/refresh</li>
</ul>
<li>Recommend.php is done (some logic by Ted)</li>
<li>Added Artists to Songs on Search.php</li>
<li>Fake chat is implemented and works</li>
<li>Can now delete playlists</li>
<li>Random Song button added to Song.php</li>
<li>Notifications are implemented</li>
<li>Can now create new playlist from Song.php if you have more than 1</li>
<li>Fixed various bugs across pages</li>
</ul>

4/24
<ul>
<li>Search.php has been fixed</li>
<li>Minor adjustments to The Michael Rosen Lounge</li>
</ul>

4/25: FACEBOOK COMMIT
<ul>
<li>Facebook has been integrated</li>
<ul>
<li>Added Facebook login/signup button to splash.php</li>
<li>Users can sign up then login with facebook </li>
<li>User's profiles display Facebook profile picture</li>
</ul>
<li>Spotify query parsing updated; looks to be correct this time</li>
<li>Logout.php is now a AJAX accessed only page; Now handled with jQuery/AJAX (Due to FB logout)</li>
<li>profilePlaylist.php now has a cleaner new stylization</li>
<li>Fixed Songs Played on Profile.php (was showing playcount) </li>
<li>Fixed NULL tags being added on recommend.php</li>
</ul>

4/26
<ul>
<li>Fixed Admin Shell Output</li>
<li>Fixed profileplaylists so delete works properly</li>
<li>Added ability to 'Like' playlists</li>
<li>Playlist.php reintroduced to house all the User's 'Liked' playlists</li>
<li>Search.php has been optimized to return fewer irrelevent results</li>
<li>Fixed a Bug where new playlists weren't being created</li>
<li>Recommend and Discover have been optimized</li>
<li>Recommend now only recommends song the User hasn't rated or played</li>
</ul>

4/27: GOOGLE EARTH COMMIT
<ul>
<li>Integrated Earth on song.php to display the location of users that listen to the song</li>
<li>Fixed a Bug where non-Facebook accounts couldn't log out</li>
<li>Added Lyrics to each song</li>
<li>New Stylization for Song.php in regards to the Google Earth and Lyric inclusions</li>
<li>Playlist addition bug fix</li>
<li>New Source for Lyrics that has entire set of lyrics, not only 150 characters</li>
<li>Piers pushed profilestats.php.</li>
</ul>

5/18
<ul>
<li>Initial actions taken to migrate site to new server </li>
</ul>

5/19-7/30
<ul>
<li>Site has been migrated to new host (link in description above </li>
<li>Many bug fixes due to migration tasks</del></li>
<li>Song chat disabled due to lack of time to fix bugs </li>
</ul>

<h1>TO BE DONE: </h1>
<ul>
<li><del>Finish templating all pages and "data-drop" where need be,namely profile.php</del></li>
<li><del>Implement full Fix search alogrithm. </del></li>
<li><del>Add logic for Friend relations</del></li>
<li><del>Add logic for playlists</del></li>
<li><del>Add logic for discover (may be random if time does not permit for logic)</del></li>
<li><del>Add logic for recommendations</del></li>
<li><del>Song Chat?</del></li>
<li><del>Fix Admin Shell Output</del></li>
</ul>
