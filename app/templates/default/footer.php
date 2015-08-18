<?php

use Helpers\Assets;
use Helpers\Url;
use Helpers\Hooks;

//initialise hooks
$hooks = Hooks::get();
?>

<footer>
    <div id="footer_featured_content">
        Here featured content will be shown
    </div>
    <div id="footer_content">
        <div id="copyright">
             © COPYRIGHT (NOT REALLY) 2015 (plz no sue)
         </div>
        <div id="footer_links">
           <ul>
                <li>
                   <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">About us</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                    <a href="#">Support</a>
                </li>
            </ul>
        </div>
    </div>  
</footer>

<!-- JS -->
<?php
Assets::js(array(
	Url::templatePath() . 'js/main.js?version=20'
));

//hook for plugging in javascript
$hooks->run('js');

//hook for plugging in code into the footer
$hooks->run('footer');
?>

</body>
</html>
