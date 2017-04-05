<template>
	<div class="panel panel-default">
		<div class="panel-heading">Notifikasi</div>
		<div class="panel-body">
			<div class="notifications">
	    <ul class="notification-list">
	        <li>
	            <div class="media">
	                <div class="media-left">
	                    <a href="#">
	                        <img src="https://cdn4.iconfinder.com/data/icons/mayssam/512/user-128.png" class="media-object cat-icon rounded" alt="...">
	                    </a>
	                </div>
	                <div class="media-body">
	                    <ul class="n-user-list">
	                    <li><a href="#"><img src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png" class="avatar rounded" alt="..."></a></li>
	                     <li><a href="#"><img src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png" class="avatar rounded" alt="..."></a></li>
	                    </ul>
	                    <p class="media-heading"><b>Ranjeet Rajput</b> and <b>Abhishek Rajput</b> followed you.</p>
	                </div>
	            </div>
	        </li>
	        <li>
	            <div class="media">
	                <div class="media-left">
	                    <a href="#">
	                        <img src="https://cdn4.iconfinder.com/data/icons/mayssam/512/heart-128.png" class="media-object cat-icon rounded-circle" alt="...">
	                    </a>
	                </div>
	                <div class="media-body">
	                    <ul class="n-user-list">
	                    <li><a href="#"><img src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png" class="avatar rounded" alt="..."></a></li>
	                     <li><a href="#"><img src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png" class="avatar rounded" alt="..."></a></li>
	                     <li><a href="#"><img src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png" class="avatar rounded" alt="..."></a></li>
	                     <li><a href="#"><img src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png" class="avatar rounded" alt="..."></a></li>
	                     <li><a href="#"><img src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png" class="avatar rounded" alt="..."></a></li>
	                    </ul>
	                    <p class="media-heading"><b>Ranjeet Rajput</b> and 4 others Like your Post.</p>
	                </div>
	            </div>
	        </li>
	    </ul>
	</div>
		</div>
	</div>
</template>

<script>
	export default {
		mounted() {

		}
	}
</script>

<style scoped>
	.notification-list, .n-user-list {
	    list-style: outside none none;
	    margin: 0;
	    padding: 0;
	}
	.notification-list > li {
	    border-bottom: 1px solid #eee;
	    margin-bottom: 5px;
	    padding: 5px 0;
	}
	.notification-list .cat-icon {
	    width: 20px;
	}
	.notification-list .avatar {
	    width: 30px;
	}

	.rounded {
	    border-radius: 0.25rem;
	}
	.n-user-list{margin-bottom:5px;}
	.n-user-list:after{clear:both; content:''; display:table;}
	.n-user-list li{float:left;}
	.n-user-list li + li{margin-left:3px;}
	.n-user-list li a, .n-user-list li a:hober{text-decoration:none;}
</style>