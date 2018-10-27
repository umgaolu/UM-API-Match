# UM Hackathon Team EXPEDITION

##About

We use the python to develop the the data assessing. by using the requests to request the given url with multiple parameters. for example there are multiple pages' dataset. we need to use the 'page' parameter to get all datasets. Then, we put all JSON data the the key (for example: "_id","consumeTime","consumptionLocation","count") to Mongodb. Next, we write another function to process the dataset that are in the Mongodb. such as calculating the total records of each 20 minutes interval. And trying to iudentify which periods of time are the high level of eating. Also, We developed the events bar that shows the event of different types presented at the moments. Remain to be improved.

### Prerequisites

Install Moloquent (Follow instruction on https://github.com/jenssegers/laravel-mongodb)

Install Guzzle

```
composer require guzzlehttp/guzzle
```

## API Used

* Events
* News
* Student_meal_consumption

## API Data Processed With pycharm(python 3.6.5)

### Python Packages

* requests
* urllib.parse
* pymongo

## Web Built With

* [Laragon](https://laragon.org/) - A high performance local development environment
* [Laravel](https://laravel.com/) - The web framework
* [Bootstrap](http://getbootstrap.com/) - The front-end component library
* [Laravel MongoDB](https://github.com/jenssegers/laravel-mongodb) - An Eloquent model and Query builder with support for MongoDB
* [Guzzle](https://github.com/guzzle/guzzle) - A PHP HTTP client that makes it easy to send HTTP requests and trivial to integrate with web services
* [Combodate](https://github.com/vitalets/combodate) - Javascript date dropdown date and time picker.

## Authors

* **Wade Tam**
* **Chen Xiaojiao**
* **Gao Lu**
