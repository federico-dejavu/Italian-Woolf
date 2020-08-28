{% autoescape false %}
<!— Output by Twig :: modul "wysiwyg" —>
	    <div class="container">
			<div class="row">
				<div class="col">
					<h2>Works</h2>
					 {% for work in works %}
				</div>
				<div class="row">
						<a href=""><b>{{ work.title }},</b></a> {{ work.year }} / {{ work.publisher }} -
						{% for author in work.author %}
						 {{ author.fullname }}
						 {% endfor %}
						<ul>
						{% for edition in work.editions %}
						<li> <a href=""><b>{{ edition.title }}</b></a> - {{ edition.year }}</li>
						 {% endfor %}
						 </ul>
					</p>
					{% endfor %}
				</div>
			</div>

			<div class="row">
				<div class="col">
					<h2>Articles {{ articles|length }}</h2>
					 {% for article in articles %}
					<p>
						<a href=""><b>{{ article.title }},</b></a> {{ article.year }} / {{ article.publisher }} -
						{% for author in article.author %}
						 {{ author.fullname }}
						 {% endfor %}
					</p>
					{% endfor %}
				</div>
			</div>




	    </div>
<!— end Twig —>
{% endautoescape %}