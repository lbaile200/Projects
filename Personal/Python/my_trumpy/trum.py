#!/usr/bin/env python

#imports
import tweepy, time, sys, os, random

#You'll need to get this from dev.twitter.com for now directly inlined, but will out to a file at some point.:
CONSUMER_KEY = 't2ka3xsLpoByGqrfZp1grPvx4'#keep the quotes, replace this with your consumer key
CONSUMER_SECRET = 'rQcGij5UGQviliiKENxaAX7rB07lGdTixsnBrAGMtPgVaLB3FX'#keep the quotes, replace this with your consumer secret key
ACCESS_KEY = '605994263-FhmZEh6vhPmH7jKDnmE0GsKEujWbjpvzjNs7h2vQ'#keep the quotes, replace this with your access token
ACCESS_SECRET = 'lDEMxjfASmKBtKWkE3AFxVSZoiVyxoPhY9sLD3EhxdNUi'#keep the quotes, replace this with your access token secret
auth = tweepy.OAuthHandler(CONSUMER_KEY, CONSUMER_SECRET)
auth.set_access_token(ACCESS_KEY, ACCESS_SECRET)
api = tweepy.API(auth)

#this allows us to point at any user without modifying the script
user = str(sys.argv[1])
print 'analyzing tweets of', user
#get most recent tweet of our user and only essential info.  Print tweet to tweetid.txt
for status in api.user_timeline(screen_name=user, count=1, trimuser=1):
    status = str(status.id)
    print 'id of latest tweet =', status
    #must make sure that script is run from root directory or else issues.
    with open('./tweetid.txt', 'r+') as tweetid:
    	first_line = tweetid.readline()
    print 'id of last tweet we responded to =', first_line
    tweetid.close()
    if first_line == status:
	print 'nothing to do here, no new tweets'
	exit()
    else:
	tweet_id = open ( './tweetid.txt', 'w+')
        tweet_id.write(status)
        tweet_id.truncate()
        tweet_id.close()
	api.update_status('@' + user + ' Shut up' + str(random.randint(0, 10000)), status)
      #  print status


