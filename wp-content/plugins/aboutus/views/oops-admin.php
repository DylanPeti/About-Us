<?php include('header.php') ?>

<div class="section signup-progress">
      <div class="container">
        <h1>You're logged in as an administrator</h1>
        <h4>Redirecting you to the CMS.</h4>
      </div>
    </div>

</div>
<script type="text/javascript">
window.setTimeout(function(){
  window.location = "/wp-admin/";
}, 3000);
</script>

<?php include('footer.php');