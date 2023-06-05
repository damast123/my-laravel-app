# my-laravel-app-test-code
 This is a test code backend for inosoft

Installation
Clone the repository:
```bash
  git clone https://github.com/your-username/your-repository.git
```

Navigate to the project directory:
```bash
  cd your-repository
```

Install the dependencies:
```bash
  composer install
```

Copy the .env.example file to .env:
```bash
  cp .env.example .env
```

Generate the application key:
```bash
  php artisan key:generate
```

Configure your database settings in the .env file.

Run the database migrations and seed your database:
```bash
  php artisan migrate:refresh --seed
```

Start the development server:
```bash
  php artisan serve
```

The application will be accessible at http://localhost:8000.

## Features

- jwt authentication
- Jenssegers\Mongodb

Usage
Please install Jenssegers\Mongodb and jwt authentication first before running your application. Please make sure your composer version is at least 2.5+ or higher.
- using jwt authentication
Install Required Packages:
```bash
  composer require tymon/jwt-auth
```

Publish Configuration Files:
```bash
  php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```
This will create a config/jwt.php file that you can modify to set up JWT authentication.

Generate JWT Secret Key:
```bash
  php artisan jwt:secret
```

This command will add the JWT secret key to your .env file. After that, don't forget to composer dump-autoload and php artisan optimize.

- using Jessengers\Mongod
Install Required Packages:
```bash
  composer require jenssegers/mongodb
```

Config your mongodb connection in the 'config/database.php' File:
```bash
  'mongodb' => [
    'driver' => 'mongodb',
    'host' => env('DB_HOST', 'localhost'),
    'port' => env('DB_PORT', 27017),
    'database' => env('DB_DATABASE'),
    'username' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'options' => [
        // Additional MongoDB options
    ],
],
```

Update your .env file with the MongoDB connection details:
```bash
    DB_CONNECTION=mongodb
    DB_HOST=127.0.0.1
    DB_PORT=27017
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
```

Use the following command to your model. in this example from model kendaraan:
```bash
    <?php
    declare(strict_types=1);
    namespace App\Models;

    use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
    ...

    class Kendaraan extends Eloquent
    {
        use HasFactory;

        protected $connection = 'mongodb';

        protected $collection = 'kendaraans';
        protected $primaryKey = '_id';

        protected $fillable = [
            'tahun_keluaran',
            'warna',
            'harga',
        ];

        ...
    }
```

## API Reference
Auth
#### Login

```http
  Post /api/login
```

| Body json  | Type     | Description                |
| :--------  | :------- | :------------------------- |
| `email`    | `string` | **Required**. User email   |
| `password` | `string` | **Required**. User email   |

#### Register

```http
  Post /api/register
```

| Body json   | Type     | Description                                    |
| :--------   | :------- | :--------------------------------              |
| `name`      | `string` | **Required|String**. Name of user              |
| `email`     | `string` | **Required|email|unique:users**. Email of user |
| `password`  | `string` | **Required|min:6**. Password of user           |

Kendaraan
In here api will need the token from login. You can use the auth type bearer token.
#### Get All Kendaraan

```http
  Get /api/kendaraan
```

#### Get Kendaraan by id

```http
  GET /api/kendaraan/show/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

#### Post Kendaraan

```http
  Post /api/kendaraan
```

| Body json              | Type          | Description                                    |
| :--------              | :-------      | :--------------------------------              |
| `tahun_keluaran`       | `string/date` | **Required**. Tahun keluaran of kendaraan      |
| `warna`                | `string`      | **Required**. Email of kendaraan               |
| `harga`                | `numeric`     | **Required|numeric**. Password of kendaraan    |
| `mesin`                | `string`      | **Required|String**. Mesin of kendaraan        |
| `kapisitas_penumpang`  | `integer`     | Kapisitas penumpang of kendaraan               |
| `tipe`                 | `string`      | Tipe of kendaraan                              |
| `tipe_suspensi`        | `string`      | Tipe suspensi of kendaraan                     |
| `tipe_transmisi`       | `string`      | Tipe transmisi of kendaraan                    |

#### Post Stock Kendaraan

```http
  Post /api/stokkendaraan
```

| Body json              | Type          | Description                           |
| :--------              | :-------      | :--------------------------------     |
| `kendaraans_id`        | `string`      | **Required**. Id of kendaraan         |
| `stock`                | `integer`     | **Required**. Stock of kendaraan      |

#### Get All Stock Kendaraan

```http
  Get /api/stokkendaraan
```

#### Get Stock Kendaraan by id

```http
  GET /stokkendaraan/show/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

Penjualan
#### Post Penjualan

```http
  Post /api/penjualan
```

| Body json       | Type          | Description                                                |
| :--------       | :-------      | :--------------------------------                          |
| `invoice`       | `string`      | **Required**. Invoice of penjualan                         |
| `tanggal`       | `string/date` | **Required**. Tanggal of penjualan                         |
| `detail`        | `array`       | **Required**. Detail array of penjualan                    |
| `jumlah`        | `integer`     | **Required**. Detail array contain jumlah of detail        |
| `harga`         | `numeric`     | **Required**. Detail array contain harga of detail         |
| `kendaraans_id` | `string`      | **Required**. Detail array contain id kendaraan of detail  |

{
  "invoice": "INV003",
  "tanggal": "2023-01-19",
  "detail": [
    {
      "jumlah": 2,
      "harga": 60000000,
      "kendaraans_id": "647d9bb0332d2574db0f2b86"
    }
  ]
}

#### Get All Penjualan

```http
  GET /api/penjualan
```

#### Get All Detail Penjualan

```http
  GET /api/penjualan/detail
```

#### Get Penjualan by id

```http
  GET /api/penjualan/show/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

Contributing
Contributions are welcome! Follow these steps to contribute:

Fork the repository.
Create a new branch for your feature/bug fix.
Make your changes and commit them.
Push your changes to your forked repository.
Submit a pull request to the original repository.
License
This project is licensed under the MIT License.

Include any other relevant sections or information that may be helpful for users or contributors.

Remember to update the sections with the appropriate information specific to your project. Provide clear instructions for installation, usage, and testing. Explain how others can contribute to your project and specify the license under which it is released.

Make sure to keep your README file up to date as your project evolves and include any additional details or documentation that would be helpful for users.
