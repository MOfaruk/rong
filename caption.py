#!/usr/bin/python
import sys
from captionbot.captionbot import CaptionBot

c = CaptionBot()
#print(sys.argv[1])
out = c.url_caption('http://mdomarfaruk.com/api/images/'+sys.argv[1]).encode('utf-8')
print(out)
