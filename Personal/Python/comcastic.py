#!/usr/bin/python
import os
import sys
import csv
import datetime
import time
import tweepy

def test():
#run speedtest-cli
    print 'running test'
    test = os.popen("python /home/cabbage/.local/lib/python2.7/site-packages/speedtest_cli.py --simple").read()
    print 'ran'
    #split the 3 line result (ping,down,up)
    lines = test.split('\n')
    print test
    ts = time.time()
    date =datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')
    #if speedtest could not connect set the speeds to 0
    if "Cannot" in test:
        p = 100
        d = 0
        u = 0
    #extract the values for ping down and up values
    else:
        p = lines[0][6:11]
        d = lines[1][10:14]
        u = lines[2][8:12]
    print date,p, d, u
    #save the data to file for local network plotting
    out_file = open('/var/www/assets/data.csv', 'a')
    writer = csv.writer(out_file)
    writer.writerow((ts*1000,p,d,u))
    out_file.close()

    #con2twitter
    def get_api():
      auth = tweepy.OAuthHandler('consumer_key', 'consumer_secret')
      auth.set_access_token('access_toke', 'access_token_secret')
      return tweepy.API(auth)

    #try to tweet even if no connection
    if "Cannot" in test:
        try:
            api = get_api()
            tweet="Hey @Comcast @ComcastCares why is my internet down? I pay for 60down\\5up in Knoxville TN? #comcastoutage #comcast"
            status = api.update_status(status=tweet)
            #twit.statuses.update(status=tweet)
        except:
            pass

    #tweet if down speed is too low
    elif eval(d)<25:
        print "trying to tweet"
        try:
            api = get_api()
            tweet="Hey @Comcast why is my internet speed " + str(int(eval(d))) + "down\\" + str(int(eval(u))) + "up when I pay for 50down\\5up in Knoxville TN? @ComcastCares @xfinity #comcast #speedtest"
            status = api.update_status(status=tweet)
            #twit.statuses.update(status=tweet)
        except Exception,e:
            print str(e)
            pass
    return
if __name__ == '__main__':
    test()
    print 'completed'