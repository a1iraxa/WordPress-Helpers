import datetime
import pytz

dt_today = datetime.datetime.today()
dt_now = datetime.datetime.now()
dt_utc = datetime.datetime.utcnow()
print(dt_today)
print(dt_now)
print(dt_utc)

# fixed using pytz (Pythin timezone) module
dt_now = datetime.datetime.now(tz=pytz.UTC)
dt_now_usa = dt_now.astimezone(pytz.timezone('US/Mountain')) 
print(dt_now)
print(dt_now_usa)


for tz in pytz.all_timezones:
	pass
	# print(tz)