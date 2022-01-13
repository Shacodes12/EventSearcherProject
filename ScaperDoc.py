#!/usr/bin/env python
# coding: utf-8

# In[3]:



#will be scapping data from worldmeter dashboeard
import pandas as pd
import urllib
import requests
from datetime import datetime
from bs4 import BeautifulSoup as bs
import dateutil.parser



def scrape_one_page(events_card):
    for i in range(len(events_card)):
        link = events_card[i].select('.eds-event-card-content__primary-content')[0].find('a')['href']
        links.append(link)
        title = events_card[i].select(
        '.eds-event-card-content__primary-content'
        )[0].find('a').find("h3").find('div').find('div').text
        titles.append(title)
        date1 , date2 = events_card[i].select('.eds-event-card-content__sub-title')

        #convert the dates to datetime format
        date_format = '%Y %a %b %d %H:%M %p'

        today_name  = datetime.now().strftime("%a")
        date1 = "2021 "+date1.text.split("+")[0].strip().replace("," , "").replace(
            "Today" , today_name).replace("at" , "").replace("S" , '').replace("Tomorrow" ,today_name)
        #date1 = datetime.strptime(date1,date_format).strftime('%Y-%m-%d %H:%M:%S')
        date1 = dateutil.parser.parse(date1).strftime('%Y-%m-%d %H:%M:%S')
        start_date.append(date1)
        date2 = "2021 "+date2.text.split("+")[0].strip().replace("," , "").replace(
            "Today" , today_name).replace("at" , "").replace("S" , '').replace("Tomorrow" ,today_name)
        #date2 = datetime.strptime(date2,date_format).strftime('%Y-%m-%d %H:%M:%S')
        date1 = dateutil.parser.parse(date1).strftime('%Y-%m-%d %H:%M:%S')
        end_date.append(date2)

        location = events_card[i].select_one(
        '.eds-event-card-content__sub').text
        locations.append(location)

        sub_page  = bs(requests.get(link).text , 'html.parser')

        if len(sub_page.select(".js-panel-display-price"))==0:
            price = sub_page.select_one(".js-display-price").text.strip()
        else:
            price = sub_page.select_one('.js-panel-display-price').text.strip()
        prices.append(price)
        description = sub_page.select_one(".has-user-generated-content").text.replace("\n" , "")
        desc.append(description)

        try:
            image_url = events_card[i].select(".eds-event-card-content__image-wrapper")[0].find("img")['data-src']
        except Exception as e:
            image_url = ""

        images.append(image_url)


# lists to hold dataset scraped
links = []
titles = []
start_date = []
end_date =[]
desc =[]
images =[]
prices =[]
locations =[]


for page in range(1 , 13):
    #url for the page to be scraped
    url = f"https://www.eventbrite.com/d/kenya--nairobi/all-events/?page={page}"
    web_url = requests.get(url).text
    soup = bs(web_url , 'html.parser')
    events = soup.select_one(".search-main-content__events-list")
    events_card =events.find_all("li")
    print(f"Page : {page}" , "********"*page)
    #scrape
    scrape_one_page(events_card)
    print(f"Done:{page}" , "*********" *page)

# create a dataframe
df = pd.DataFrame()
# insert data to the df
df['title'] = titles
df['link'] = links
df['description'] = desc
df['start_date'] = start_date
df['end_date'] = end_date
df['location'] = locations
df['price'] = prices
df['img_url'] = images

print("Finished processing")



df.shape



df.head()


old_df = pd.read_csv("Scraped.csv")



print(f"Total Duplicates are {pd.concat([old_df , df]).duplicated().sum()}")



# drop duplicates
non_dup = pd.concat([old_df , df]).drop_duplicates(keep='first')



non_dup.to_csv("Scraped.csv" , index = False)



import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database ='project'
)



mycursor = mydb.cursor()

mycursor.execute("SHOW TABLES")
for x in mycursor:
      print(x)
mydb.commit()



def insert_data(eventId ,title , description ,organizer_name ,eventAt , location  ,image , postedAt):
    mycursor = mydb.cursor()
    eventAt= pd.to_datetime(eventAt).strftime('%Y-%m-%d %H:%M:%S')
    postedAt =pd.to_datetime(postedAt).strftime('%Y-%m-%d %H:%M:%S')
    insertDetails = f"""
    INSERT into Events(eventId ,title , description ,organizer_name ,eventAt , location  ,image , postedAt)
    VALUES(%s,%s,%s,%s,%s,%s,%s,%s)
    """
    VALUES = (eventId,title,description,organizer_name ,eventAt,location,image,postedAt)
    mycursor.execute(insertDetails , VALUES)
    mydb.commit()
    print(mycursor.rowcount, "record inserted.")
    




import pandas as pd
data = pd.read_csv("Scraped.csv")


# data.columns
import uuid

data.columns



data.fillna(value = "" , inplace = True)



# add data from dataframe to mysql table
for i in range(data.shape[0]):
    insert_data(
    str(uuid.uuid4()),
    data.iloc[i]['title'],
    data.iloc[i]['description'],
    "EVENT BRITE",
    data.iloc[i]['end_date'],
    data.iloc[i]['location'],
    data.iloc[i]['img_url'],
    data.iloc[i]['start_date']
    )
    
print(f"Done Inserting data")


