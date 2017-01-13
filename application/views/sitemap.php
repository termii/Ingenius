<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url();?></loc> 
        <priority>1.0</priority>
    </url>
    <?php foreach($stories as $sto): ?>
    <url>
        <loc><?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?></loc>
        <lastmod><?php echo date('c', strtotime($sto['post_date'])); ?></lastmod>
        <priority>0.5</priority>
    </url>
    <?php endforeach; ?>
    <?php foreach($pages as $pa): ?>
    <url>
        <loc><?php if ($pa['link']) { echo $pa['link']; } else { echo base_url()."pages/p/".$pa['title_slug']; } ?></loc>
        <priority>0.5</priority>
    </url>
    <?php endforeach; ?>

</urlset>