class HtmlBuilder {

    buildHtml(obj) {

        tempImage = this.getThermometerImage(obj);
        weatherImage = this.getWeatherImage(obj);
        
        html =
        '<div class="border border-success rounded bg-light">' +
            '<div class="row d-flex justify-content-center mt-2 ms-2">' +
                '<div class="col-md-auto">' +
                    '<a class="display-3 text-decoration-none text-primary">' + tempImage + ' ' + obj.main.temp + ' °C</a><br>' +
                '</div>' +
                '<div class="col text-center">' +
                    '<div class="row">' +
                        weatherImage +
                        '<a class="text-decoration-none text-secondary">' + obj.weather[0].description + '</a><br>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="row mb-2">' +
                '<div class="col text-center display-4 text-secondary"><i class="fa-solid fa-wind display-4"></i> ' + obj.wind.speed + ' m/s</div>'+
            '</div>'
        '</div>'

        return html;
    }

    getThermometerImage(obj) {
        switch(true) {
            case (obj.main.temp < 5):
                tempImage = '<i class="fa fa-thermometer-0" aria-hidden="true"></i>'
                break;
            case (obj.main.temp > 5.001 && obj.main.temp < 10):
                tempImage = '<i class="fa fa-thermometer-1" aria-hidden="true"></i>'
                break;
            case (obj.main.temp > 10.001 && obj.main.temp < 20):
                tempImage = '<i class="fa fa-thermometer-2" aria-hidden="true"></i>'
                break;
            case (obj.main.temp > 20.001):
                tempImage = '<i class="fa fa-thermometer-3" aria-hidden="true"></i>'
                break;
            default:
                tempImage = ''
            }

        return tempImage;
    }

    getWeatherImage(obj) {
        switch(true) {
            case (obj.weather[0].main == 'Rain'):
                weatherImage = '<i class="fa-solid fa-cloud-rain display-5"></i>';
                break;
            case (obj.clouds.all == 0):
                weatherImage = '<i class="fa-solid fa-sun text-warning display-5"></i>';
                break;
            case (obj.clouds.all < 15):
                weatherImage = '<i class="fa-solid fa-cloud-sun text-muted display-5"></i>';
                break;
            case (obj.clouds.all > 15.001 && obj.clouds.all <= 100):
                weatherImage = '<i class="fa-solid fa-cloud text-muted display-5"></i>';
                break;
            default:
                weatherImage = '';
            }
        
        return weatherImage;
    }
}