<div id="main">
	{* show the selected images*} {foreach $photos as $photo}
	<div style="float: left; margin-left: 20px;">
		<a href="photo.php?id={$photo->id}"> <img src="{$photo->image_path()}"
			width="200" />
		</a>
		<p>{$photo->caption}</p>
	</div>
	{/foreach} {* show the pagination controls *}

	<div id="pagination" style="clear: both;">
		{if {$pagination->total_pages()} gt 1 } {if
		{$pagination->has_previous_page()}} <a
			href="index.php?page={$pagination->previous_page()}">&laquo; Previous</a>
		{/if} {for $i=1 to {$pagination->total_pages()}} {if $i eq $page } <span
			class="selected">{$i}</span> {else} <a href="index.php?page={$i}">{$i}</a>
		{/if} {/for} {if {$pagination->has_next_page ()}} <a
			href="index.php?page={$pagination->next_page()}">Next &raquo;</a>
		{/if} {/if}
	</div>
</div>

