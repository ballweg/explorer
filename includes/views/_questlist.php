<!-- quest list -->
<div data-role="collapsible-set" data-theme="c" data-content-theme="c">
<?php foreach ($quests as $quest){ ?>
	<div data-role="collapsible" data-iconpos="right" id="quest-<?php echo $quest->id ?>">
		<h3>
			<img src="<?php echo $quest->icon_url ?>" alt="<?php echo $quest->name ?>" class="ui-li-icon-exp"/>
			<?php echo $quest->name ?>
		</h3>
		<ul data-role="listview" data-inset="false">
			<?php $name = $quest->short_name;?>
			<?php foreach ($content[$name] as $challenge){ ?>
				<li id="challenge-<?php echo $challenge->id ?>">
					<a href="#<?php echo $quest->short_name; echo $challenge->id ?>"><?php echo $challenge->org ?></a>
				</li>
			<?php } ?>
		</ul>
	</div>
<?php } ?>
</div>
