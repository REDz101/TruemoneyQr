### TruemoneyWallet QR

```php
require "TruemoneyWalletQr.php";
$tmw = new TruewalletQr();
//	    	          เบอร์   จำนวนเงิน
echo $tmw->qrcode('099xxxxxxxxx', 100.00);
```
