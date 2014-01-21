WHAT DID I DO???

A journal of activities on 10/1/2013, wherby we successfully pushed a PHP app to heroku that uses leaflet.

1. First roadblock:  Could not authenticate to heroku (PK encryption failed, permission denied)

2. Second roadblock:  Could not combine PHP with leaflet javascript from Ruby app 'my_new_app'

	Solution: 1. Made sure the SSH option was checked in a custom Heroku toolbelt installation.
			  2. Removed all keys on the Windows box (Keys are kept in C:\Users\Administrator\.ssh)
			  3. Once keys removed, logged in as dah_7@yahoo.com  Was prompted to generate a key.
			  4. Added the key to heroku using heroku keys:add command or similar.
			  5. Followed the leaflet entry-level instructions and inserted some PHP in the body of the HTML.
			  6. Created a fresh app using heroku create, then did git init, git add * and git commit
			  7. Finally, did a git push heroku master (not origin master, since heroku is the repository).
			  
  NOTE:  You only need one key on any one machine.  Even for multiple projects (e.g., Ruby and PHP projects
		can share the same key.)

3. Big time sink on getting the lat / lon integrated into the main mobile app.  Brother, Know Thyself!  

4. Basic functions in place as of 10.26.13.  There is still a blue 'trombone slider' on the UI, however. :|

5. Used the <ul> <li> combo to get the images to appear on top of the same spot.

6. THis is still a toy, but it's cool.  