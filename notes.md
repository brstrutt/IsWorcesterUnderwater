So I had the dumb idea to create a website akin to isitchristmas.com, except rather than reporting christmas information it would report flooding in Worcester information.
(on closer inspection isitchristmas.com does that cool flag thing also. I will not be doing that. I'm dipping my toe in webdev right now so no I'm not creating a massively multiplayer experience).

But how can I automatically determine if Worcester is flooding?
I found a few websites that report this info at specific points along the river (https://flood-warning-information.service.gov.uk/station/2092?direction=u and https://flood-warning-information.service.gov.uk/station/2039?direction=u being the best ones I found).
This lead me to the Environment Agency Real Time flood-monitoring API (https://environment.data.gov.uk/flood-monitoring/doc/reference).
For my purposes I'm thinking if I grab current river levels at Barbourne and Diglis and compare them to the flood risk levels (3.35m and 2.80m respectively) then I could switch based on that.
Thing is, at time of writing the river levels peaked above those levels yesterday but I don't think worcester was properly underwater....so I could add some value to those heights and treat those as "DEFO FLOOD LEVELS"
Or I could use a tangential API that actually reports Flood Alerts and Warnings, as the FloodMonitoring API does provide this info too and just go form that...

But before I get ahead of myself, I need to figure out how I'm accessing this API in the first place. My current preference is php so visitors don't get forced to call out to a third party (I don't wanna have to mess with my script blocker to allow this website to function).
Could dip into javascript instead....yeah maybe not. Lets deepen php knowledge rather than jackofalltradesing it.

So how the butts to I access this API with PHP? Well I wanted to add a detailed info page anyway with actual levels and warnings listed so I may as well dev the php on that page.

So I got the access working in php. Turns out the API works by just, providing raw json when you visit the right address

WHY IS PHP NOT DOING THE THING I WANT? I just want to store whether or not two things are flooding and return true if they are both flooding. But it's working backwards and I dont know why.