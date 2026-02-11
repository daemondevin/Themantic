<div class="ui fixed inverted menu">
    <div class="ui container">
        <a href="[[~[[++site_start]]]]" class="header item">
            <img class="logo" src="[[++assets_url]]components/themantic/images/logo.png" alt="[[++site_name]]">
            [[++site_name]]
        </a>
        
        [[ThematicMenu? 
            &startId=`0` 
            &level=`1` 
            &classNames=`item`
        ]]
        
        <div class="right menu">
            <div class="item">
                <div class="ui icon input">
                    <input type="text" placeholder="Search...">
                    <i class="search link icon"></i>
                </div>
            </div>
            [[!+modx.user.id:notempty=`
                <a class="ui item" href="[[~[[++themantic.account_page_id]]]]">
                    <i class="user icon"></i> Account
                </a>
                <a class="ui item" href="[[~[[++themantic.logout_resource_id]]? &returnUrl=`[[~[[++site_start]]]]`]]">
                    Logout
                </a>
            `:default=`
                <a class="ui item" href="[[~[[++themantic.login_resource_id]]]]">
                    Login
                </a>
                <a class="ui button primary" href="[[~[[++themantic.register_resource_id]]]]">
                    Sign Up
                </a>
            `]]
        </div>
    </div>
</div>

<!-- Mobile Menu Toggle -->
<script>
$(document).ready(function() {
    $('.ui.sidebar').sidebar('attach events', '.toc.item');
});
</script>
