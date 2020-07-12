{% autoescape false %}
<!-- Output by Twig :: modul "wysiwyg" -->
	    <div class="container">
			{% set test_works = 0 %}
			{% for work in works %}
				{% if work.type == "work" %}
					{% set test_works = 1 %}
				{% endif %}
			{% endfor %}
			{% if test_works == 1 %}
			<div class="row">
				<div class="col">
					<h2>Works {{ works|length }}</h2>
					 {% for work in works %}
					 {% if work.type == "work" %}
					<p>
						<a href=""><b>{{ work.title }},</b></a> {{ work.year }}
					</p>
					{% endif %}
					{% endfor %}
				</div>
			</div>
			{% endif %}
			{% set test_article = 0 %}
			{% for work in works %}
				{% if work.type == "article" %}
					{% set test_article = 1 %}
				{% endif %}
			{% endfor %}
			{% if test_article == 1 %}
			<div class="row">
				<div class="col">
					<h2>Articles {{ works|length }}</h2>
					 {% for work in works %}
					 {% if work.type == "article" %}
					<p>
						<a href=""><b>{{ work.title }},</b></a> {{ work.year }}
					</p>
					{% endif %}
					{% endfor %}
				</div>
			</div>
			{% endif %}
	    </div>
<!-- end Twig -->
{% endautoescape %}