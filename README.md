**Install PHP(8.1) for Project Basic Setup**

**Clone bitbucket**

    git clone https://github.com/rahulpandya011/webpatriot-practical.git

**Install Laravel dependency using below commands**

    composer install

**Copy .env.example to .env file and update .env file with your configuration values**

    sudo cp .env.example .env

**Migrate and seed database with tablses and predefined data**

    php artisan migrate:fresh --seed

**Generate Key using below commands**

    php artisan key:generate

**In Terminal run below command for run project for Development Only**

**Laravel :** `php artisan serve`

**Login In Page**

![Example Image](https://drive.google.com/uc?id=1A0rXf2kmvvRfj-WIosXWDyr18uqF3_tj)

**Register Page**

![Example Image](https://drive.google.com/uc?id=1fK0dz76iYIvYH1yGDGDKu-y6UBb-Fn8Z)

**User List Page**

![Example Image](https://drive.google.com/uc?id=1gyQbpozd1y2Hxk8auEuoKvh6-0qELcWB)
