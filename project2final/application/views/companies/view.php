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
<h3><?php print $vars['data']->name; ?></h3>

<img src="<?php print base_url() . 'uploads/' . $vars['data']->profile_pic; ?>" />

<p class="info">Phone: <?php print $vars['data']->phone; ?></p>

<p class="info">Email: <a href="mailto:<?php print $vars['data']->email; ?>"><?php print $vars['data']->email; ?></a></p>

<p class="info">Company Website: <a href="http://<?php print $vars['data']->website; ?>"><?php print $vars['data']->website; ?></a></p>

<p class="info">Address: <?php print $vars['data']->address; ?></p>
<div id="map-canvas" style="height: 350px;"></div>

<hr />
<p>Associated People:</p>
<?php foreach($vars['people'] as $obj): ?>
	<p><a href="<?php print base_url() . 'index.php/people/view/' . $obj->id; ?>"><?php print $obj->lname . ', ' . $obj->fname; ?></a></p>
<?php endforeach; ?>

<hr/>
<p class="info">Note(s):</p>
<?php 
$i = 1;
foreach($vars['notes'] as $note): ?>
	<p><?php print "$i) " .$note->note; ?><br /><a href="<?php print base_url(); ?>index.php/companynotes/view/<?php print $vars['notes']->id; ?>">View Note</a></p>
<?php 
++$i;
endforeach; ?>

<hr />
<p><a href="<?php print base_url(); ?>index.php/companies/edit/<?php print $vars['data']->id; ?>" class="button secondary">Edit Company</a>   <a href="<?php print base_url(); ?>index.php/companynotes/create/<?php print $vars['data']->id; ?>" class="button secondary">Add a note</a>   <a href="<?php print base_url(); ?>index.php/companies/changepic/<?php print $vars['data']->id; ?>" class="button secondary">Change Company Picture</a>   <a href="<?php print base_url(); ?>index.php/companies/confirm/<?php print $vars['data']->id; ?>" class="button alert">Delete Company</a></p>