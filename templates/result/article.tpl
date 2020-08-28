{% autoescape false %}
<!— Output by Twig :: modul "wysiwyg" —>
	    <div class="container">
			<div class="row">
			<div class="row">
				<div class="col">
					<h2>Articles</h2>
				</div>
			</div>
			{% for article in articles %}
			<div class="row">
				<div class="col">
					<a href=""><b>{{ article.title }},</b></a> {{ article.year }} / {{ article.publisher }} -
						{% for author in article.author %}
							{{ author.fullname }}
						{% endfor %}
				</div>
			</div>
			{% endfor %}
		</div>
<!— end Twig —>
{% endautoescape %}