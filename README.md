# form-wit-component

form-wit-component

## Installation

```bash
composer require ycookies/filament-form-wit-component
```
## form compoennt week time picker

## Screenshot
![](https://main.dcat-admin.com/images/filment-form1.jpg)

## Support
[dcat-admin](https://forum.saishiyun.net/)

## Use 

```php
use Ycookies\FormWitComponent\Forms\Components\WeekTimePicker;

WeekTimePicker::make('week_time')
                    ->required()
                    ->validationMessages([
                        'required' => '请选择周时间段',
                    ]),
```


