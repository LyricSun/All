<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 2017/10/31
 * Time: 上午8:49
 */
return [
    //应用对应的appID
    'app_id' => '2016082500310184',
    //公钥
    'alipay_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtk6aGvtozCei6DdF1rb9nVh3U/yO896Fa6O3LZR0SrNelGmo87kWuRjpPSm8pkmciCqI9EO74Sw9LqUC0T+iWubEcM1/02GC0X9reZ3tL0RXZBXcXv21K4BGd5l6zU3bT3QIm6z/Di70zNmnZXrk+7NDYovsJqHpP/q9VkyCVAeXP7+8mNnxk66Bq1uYk5YNOStWvqYmAxERJ0ULlQaWaKL/Gu960qX3kExhqVirfZPx8BaS9sMYiNPmumHJojlkq59vV3JEzNU/R95jOzQZ+79/LxCIK079V5WMud6CPgEU8bYyfM/mMyNGwK1nRhwBYPF1XFpUnF4LWeRn7OZtPwIDAQAB',
    //字符集
    'charset' => 'UTF-8',
    //加密类型
    'sign_type' => 'RSA2',
    //网关地址
    'gatewayUrl' => 'https://openapi.alipaydev.com/gateway.do',
    //私钥
    'merchant_private_key' => 'MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQC2Tpoa+2jMJ6LoN0XWtv2dWHdT/I7z3oVro7ctlHRKs16UaajzuRa5GOk9KbymSZyIKoj0Q7vhLD0upQLRP6Ja5sRwzX/TYYLRf2t5ne0vRFdkFdxe/bUrgEZ3mXrNTdtPdAibrP8OLvTM2adleuT7s0Nii+wmoek/+r1WTIJUB5c/v7yY2fGTroGrW5iTlg05K1a+piYDEREnRQuVBpZoov8a73rSpfeQTGGpWKt9k/HwFpL2wxiI0+a6YcmiOWSrn29XckTM1T9H3mM7NBn7v38vEIgrTv1XlYy53oI+ARTxtjJ8z+YzI0bArWdGHAFg8XVcWlScXgtZ5Gfs5m0/AgMBAAECggEAZnOZyxwKcuC7fkDBsL65nBlBRiOiuo4M8MbahHTvPaO7vS/70Kvthyvmt4ajC9hGbYdp28vM4+gWogX9pVZbiTYyoyn5cfNUryMqZPhJeMyxR/+5DnEJxV6bO083YfUlEGunAsWfuHrO++g9WJxN3t2JOvJjTfqjuF7S1JK+kzWV7pqUC6qRb1IrHuvHchDYU0RhDQESvjpAgKluAJbi/keOccxEZrsIy27ItGqMyrQskFVv3RYpBu2roONADyblp2GRSirLSJ/7o9AYuBjReWIp506Sg8kWpiXXQnaDKlU3RklOo2W/Tvy/JneWcZUupCG+5VvKh8sH+xpgnt7E4QKBgQDewvCfycJT+n3/v/Temgi9gxCxofIxs/AVJKKrOLvAbUA9J7r2TdHQMkUha06KjQmOBTHRcDFu7XaesiJ5zpPXJKjCKFiwRKLApNhhnce8mDfeYzmCfCtt2A4cnmLoSwGaIcQSOAkVaVO/AQYGBdFwJkKWoIqqn/z8+niypipk2QKBgQDRgmFMZI8mFg6yCijVYEwqTRJfCbLNYBFv7ihUJAoyINjY/Vkz8AdbaXx7rX6ohzbqZjAWhF9S2kdXMfJDD+r47gzYVjRxLxs1HLFsss6uQO5TM1lIUAMjg9XOVL7cRLWmhdFeAFJpYd4AQQ9J8Zim0sdtXxT+G6Wpo9ertAiz1wKBgBRac2nmIV9S79hCTblZEZtfMlNInLx12GXWJxbF5EG8ubXcv3Rpv9XqAe7/wvld0ZWsW9TrD1k3UTNGy2edvFxX+SNkVFYmr0gyx6KDrBBLSC+FmWeWuNEcgI2U2yymTcsrcqLHg+z05rX4/ffm6C/7DvJ8UK8uVws2R3jrPcxhAoGABPLbcX5+kxu6RSJQTJn1spoXcP89pfQ69TXe5f3j78Mu3BE/5iYpRlN7iUBT2Y84ENlREXcW+VIGlVysqEDb//0/eGyw2GuQbPS8jCC9GQiXmIeB+F9Lc69NgY4m4/ULhV9rzpibWbniEId44Po/7NDVvROd31Kv2w3vrjKWcgkCgYBBTX/q9d50O8SNhby36q1cYyPlJmZ6uCELUFjX2zVKYW96c9UQZgIzp+/7/790PeVOy3vPWodsuPMzzyKVe3cRUaR82Lk1OEipIUd0Ou6s4+jRWTJRqKTXk19Kp4vn9Psb/P5vqCbEJLFEIUmbSQQLcmRPYgMaZW+g+pm9ZrBNUQ==',
    //服务器回调地址
    'notify_url' => 'http://business.local/index/notify/index',
    //前端跳转地址 不能带任何参数
    'return_url' => 'http://business.local/index/order/finish_front'
];