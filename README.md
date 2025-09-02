Warning: I have not used this adserver for quite some time as I don't have enough impressions to warrant it. I did merge in some dependabot PRs without testing. I hope to one day have enough ad impresions to use this project again.

## GreenRobot Open-source Adserver
This adserver rotates banner ads between AdSense/AdMob, LifeStreetmedia, and others based on RPM. For AdSense/AdMob and Lifestreetmedia, the RPM is automatically retrieved by the server using network APIs, for other networks you will have to edit the RPM yourself.

This adserver is for desktop sites and mobile web, as well as native mobile apps.  Specifically, I use it on a Facebook app, which is also accessible outside of the Facebook frame once you're logged in via Facebook connect.  It should also work fine on desktop or mobile web sites not using Facebook login.  For mobile apps, I have made some code available to work with the adserver. I am still working on this, including adding documentation.

For iOS: https://github.com/greenrobotllc/adserver-ios-sdk

For Android: https://github.com/greenrobotllc/adserver-android-sdk

![Screenshot 1](https://raw.githubusercontent.com/greenrobotllc/adserver/master/sampleimages/image1.png)
![Screenshot 2](https://raw.githubusercontent.com/greenrobotllc/adserver/master/sampleimages/image2.png)
![Screenshot 3](https://raw.githubusercontent.com/greenrobotllc/adserver/master/sampleimages/image3.png)
![Screenshot 4](https://raw.githubusercontent.com/greenrobotllc/adserver/master/sampleimages/image4.png)
![Screenshot 5](https://raw.githubusercontent.com/greenrobotllc/adserver/master/sampleimages/image5.png)


## Requirements:
I recommend using Linux or Mac OS X. I have not tried this under Windows. For production/linux, I have it deployed to a Centos 7 server on Linode and it's running currently. For development, I used Mac OS X with Laravel Homestead development environment. I later switched to Laradock.

## Steps to install for production:
For installing to Centos Linux using Docker, please check out these install instructions:
[INSTALL ON CENTOS 7](https://github.com/greenrobotllc/adserver/blob/master/INSTALL_CENTOS_7.md)

## Steps to install for development on Mac OS X:
For installing to Mac OS X using Docker, please check out these install instructions:
[INSTALL ON MAC_OS_X](https://github.com/greenrobotllc/adserver/blob/master/INSTALL_MAC_OSX.md)

## FAQ:
What is the route I am suppose to provide for the Adsense Oauth Callback when setting up the google_clients_secrets.json? The route would be the address of your webserver. You should setup a domain or subdomain for it to work. For example: https://yoursubdomain.greenrobot.com/refresh

## Developer Notes
Note for developers: I have set debug to false in config/app.php so this is ready to go for production installs. If you wish to debug, set this value to true. Setting it to true may cause your database password to be exposed if a connection error occurs.

## Contact / Security Bugs
You can use Github issues for regular bugs and feature requests. For security issues or if you have any questions you don't want to discuss publicly you can email me: andy@greenrobot.com

## Facebook Discussion Group
Join the discussion on Facebook about GreenRobot Adserver: https://www.facebook.com/groups/greenrobotadserver/

## Twitter Updates
Follow GreenRobot Adserver on Twitter: https://twitter.com/GRAdserver


## TODO
-Fix errors from phpcs

-Document iOS & Android sdk integration

-I would like to add Facebook Audience network to this adserver.

## Contributing

We take openness and inclusivity very seriously. To that end we have adopted the following code of conduct.

[Contributor Code of Conduct](CODE_OF_CONDUCT.md)




### Sponsored by GreenRobot LLC

**GreenRobot Sites:**

- [GreenRobot LLC Homepage](https://greenrobot.com) - GreenRobot LLC Homepage
- [Robot Designs](https://robots.greenrobot.com) - Check out thousands of robot designs
- [AI Careers](https://aicareers.greenrobot.com) - Find thousands of Artificial Intelligence and Machine Learning (AI/ML) careers. Updated every few hours with new jobs from VC funded companies.
- [Longevity](https://longevity.greenrobot.com) - Information, research and interactive tools focused on longevity.
- [Launch Day](https://launchday.greenrobot.com) - Get your site ready for launch with this collaborative marketing and tech validation check list.
- [Remote Dev Jobs](https://remotedevjobs.greenrobot.com) - Find thousands of Remote Developer/Engineer jobs. Updated every few hours with new jobs from VC funded companies.
- [Mental Health Lawyers](https://mentalhealthlawyers.greenrobot.com) - Directory of Mental Health Lawyers in the USA for involuntary commitment and guardianship issues.
- [3D Web Games](https://3dwebgames.com) - Discover 3D web games in this curated directory in the style of a video game store/Blockbuster.
- [3D Tank Battle](https://3dtankbattle.com) - Fun free tank survival game. No login or app required.
- [Cartoonify](https://cartoonify.greenrobot.com) - Turn Yourself Into A Cartoon for Free.
- [Job Search](https://jobsearch.greenrobot.com) - Discover jobs at portfolio companies backed by Venture Capitalists
- [Wizard Writer](https://wizardwriter.greenrobot.com) - Automatically write blog posts
- [Pirate Game](https://pirates.greenrobot.com) - Ahoy! Sail the high seas in this pirate game.
- [Open Space Game](https://openspace.greenrobot.com) - Explore space in this open source space game for iOS and Mac.


