{% autoescape false %}
<!— Output by Twig :: modul "wysiwyg" —>
	    <div class="container">
			<div class="col">
				<div class="row">
					<h2>Works</h2>
				</div>
				{% for work in works %}
				<div class="row">
					<a href="work.php?subject={{ work.title }}&id={{ work.id }}"><b>{{ work.title }},</b></a> {{ work.year }} / {{ work.publisher }} -
					{% for author in work.author %}
						 {{ author.fullname }}
					{% endfor %}
					<ul>
						{% for edition in work.editions %}
							<li> <a href="edition.php?subject={{ edition.title }}&id={{ edition.id }}"><b>{{ edition.title }}</b></a> - {{ edition.year }}</li>
						{% endfor %}
					</ul>
				</div>
				{% endfor %}
			</div>
			<div class="col">
				<div class="row">
					<h2>Articles</h2>
				</div>
				{% for article in articles %}
				<div class="row">
					<a href="article.php?subject={{ article.title }}&id={{ article.id }}"><b>{{ article.title }},</b></a> {{ article.year }} / {{ article.publisher }} -
						{% for author in article.author %}
							{{ author.fullname }}
						{% endfor %}
				</div>
				 {% endfor %}    
			</div>
		</div> {# container #}
<!— end Twig —>
{% endautoescape %}