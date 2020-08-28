{% autoescape false %}
<!— Output by Twig :: modul "wysiwyg" —>
	    <div class="container">
			<div class="row">
				<div class="col">
					<h2>Works</h2>
				</div>
			</div>
			{% for work in works %}
			<div class="row">
				<div class="col">
					<a href=""><b>{{ work.title }},</b></a> {{ work.year }} / {{ work.publisher }} -
					{% for author in work.author %}
						 {{ author.fullname }}
					{% endfor %}
					<ul>
						{% for edition in work.editions %}
							<li> <a href=""><b>{{ edition.title }}</b></a> - {{ edition.year }}</li>
						 {% endfor %}
					</ul>
				</div>
			</div>
			{% endfor %}

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