<?php
    if (!$this->session->userdata('username')) {
        redirect(base_url() );
    }
?>
<script type="text/javascript">
    function initialize() {
        var mapOptions = {
          	center: new google.maps.LatLng(<?php print $vars['data']->lat; ?>, <?php print $vars['data']->long; ?>),
          	zoom: 14,
          	mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);

        var marker = new google.maps.Marker({
            position: map.getCenter(),
            map: map,
            title: '<?php print $vars['data']->address; ?>',
            clickable: true
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<h3><?php print $vars['data']->title . ' ' . $vars['data']->fname . ' ' . $vars['data']->lname; ?></h3>

<img src="<?php print base_url() . 'uploads/' . $vars['data']->profile_pic; ?>" />

<p class="info">Phone: <?php print $vars['data']->phone; ?></p>

<p class="info">Mobile: <?php print $vars['data']->mobile; ?></p>

<p class="info">Email: <a href="mailto:<?php print $vars['data']->email; ?>"><?php print $vars['data']->email; ?></a></p>

<p class="info">Personal Website: <a href="http://<?php print $vars['data']->website; ?>"><?php print $vars['data']->website; ?></a></p>

<p class="info">Address: <?php print $vars['data']->address; ?></p>
<div id="map-canvas" style="height: 350px;"></div>

<hr />
<p class="info">Associated Company: <a href="<?php print base_url() . 'index.php/companies/view/' . $vars['per_company']->id; ?>"><?php print $vars['per_company']->name; ?></a></p>

<hr/>
<p class="info">Note(s):</p>
<?php 
$i = 1;
foreach($vars['notes'] as $note): ?>
	<p><?php print "$i) " . $note->note; ?><br /><a href="<?php print base_url(); ?>index.php/personnotes/view/<?php print $vars['notes']->id; ?>">View Note</a></p>
<?php 
++$i;
endforeach; ?>

<hr />
<p><a href="<?php print base_url(); ?>index.php/people/edit/<?php print $vars['data']->id; ?>" class="button secondary">Edit Person</a>   <a href="<?php print base_url(); ?>index.php/personnotes/create/<?php print $vars['data']->id; ?>" class="button secondary">Add a note</a>   <a href="<?php print base_url(); ?>index.php/people/changepic/<?php print $vars['data']->id; ?>" class="button secondary">Change Profile Picture</a>   <a href="<?php print base_url(); ?>index.php/people/confirm/<?php print $vars['data']->id; ?>" class="button alert">Delete Person</a></p>
