<!-- Footer -->
<div class="ui inverted vertical footer segment">
    <div class="ui container">
        <div class="ui stackable inverted divided equal height stackable grid">
            <div class="three wide column">
                <h4 class="ui inverted header">About</h4>
                <div class="ui inverted link list">
                    <a href="[[~[[++themantic.about_page_id]]]]" class="item">About Us</a>
                    <a href="[[~[[++themantic.contact_page_id]]]]" class="item">Contact</a>
                    <a href="#" class="item">Privacy Policy</a>
                </div>
            </div>
            <div class="three wide column">
                <h4 class="ui inverted header">Services</h4>
                <div class="ui inverted link list">
                    <a href="#" class="item">Service 1</a>
                    <a href="#" class="item">Service 2</a>
                    <a href="#" class="item">Service 3</a>
                </div>
            </div>
            <div class="seven wide column">
                <h4 class="ui inverted header">[[++site_name]]</h4>
                <p>[[++themantic.footer_text:default=`Powered by Themantic - The ultimate MODx template with Semantic UI integration.`]]</p>
            </div>
        </div>
        <div class="ui inverted section divider"></div>
        <div class="ui horizontal inverted small divided link list">
            <a class="item" href="[[~[[++site_start]]]]">© [[++themantic.copyright_year:default=`2025`]] [[++site_name]]</a>
            <a class="item" href="#">Terms</a>
            <a class="item" href="#">Privacy</a>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Semantic UI JavaScript -->
<script src="[[++assets_url]]components/themantic/semantic-ui/semantic.min.js"></script>

<!-- Themantic Custom JavaScript -->
<script src="[[++assets_url]]components/themantic/js/themantic.js"></script>

<!-- Additional footer scripts -->
[[*customScripts]]
