<?php

for ($i=0; $i < sizeof($list_product) ; $i++) { 
?>
<a href="http://103.24.12.244/kapan-lagi/cek-token.htm?KLKeyToken=8JJpH9a0dPARlMNA1FqCfENOD50&KLKeyDesc=J+CQP0Ra3x2uNTjUypL3QNWkPig=&KLKeyProduct=<?=$i?>"><button><?=$list_product[$i] ?></button></a>
<?php
}
?>