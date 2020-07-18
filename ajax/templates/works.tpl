{% autoescape false %}
<!— Output by Twig :: modul “wysiwyg” —>
	    <div class=“container”>
			<div class=“row”>
				<div class=“col”>
					<h2>Works {{ works|length }}</h2>
					 {% for work in works %}
					<p>
						<a href=“”><b>{{ work.title }},</b></a> {{ work.year }} / {{ work.publisher }} -
						{% for author in work.author %}
						 {{ fullname }}
						 {% endfor %}
					</p>
					{% endfor %}
				</div>
			</div>
	    </div>
<!— end Twig —>
{% endautoescape %}