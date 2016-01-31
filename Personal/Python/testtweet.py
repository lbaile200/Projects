import tweepy

def get_api(cfg):
  auth = tweepy.OAuthHandler(cfg['consumer_key'], cfg['consumer_secret'])
  auth.set_access_token(cfg['access_token'], cfg['access_token_secret'])
  return tweepy.API(auth)

def main():
  # Fill in the values noted in previous step here
  cfg = {
    "consumer_key"        : "9SAs3qCVxTAuckbnb95kCm2Mk",
    "consumer_secret"     : "Ism3ukdFOob3D2X7eHBw0knSQcIdK0CaeiqZNUsSKOaIOMcUAt",
    "access_token"        : "605994263-sxgJAUHnb9wao2Kn0tru5huA9QipfbWQjLl153jx",
    "access_token_secret" : "XAmRKu6P7lUcY2hcVZKmguV1SQLeyOGQTIoPasgFVxMxg"
    }

  api = get_api(cfg)
  tweet = "Hello, world!"
  status = api.update_status(status=tweet)
  # Yes, tweet is called 'status' rather confusing

if __name__ == "__main__":
  main()
