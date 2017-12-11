#!/usr/bin/python
import os
import sys
import csv
import datetime
import time

def test():
#python has it's own speedtest utility, so we use this.
    print 'running test'
    test = os.popen("python /home/cabbage/.local/lib/python2.7/site-packages/speedtest.py --simple").read()
    print 'ran'
    #Get the useful lines.
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
    #save the data to file for local network plotting.  You'll want to change this for your own machine
    out_file = open('/home/cabbage/Documents/speeds.csv', 'a')
    writer = csv.writer(out_file)
    writer.writerow((ts*1000,p,d,u))
    out_file.close()
    test()
    print 'completed'

test()
