<h1><?php echo __('Explorar datos'); ?></h1>
<h2><?php echo __('Acceso a información sobre saneamiento en tu país y en Latinoamérica.'); ?></h2>
<ul class="nav nav-pills">
  <li <?php echo $menu == 'explore' ? 'class="active"' : ''?>>
    <a href="explore">Mapa</a>
  </li>
  <li <?php echo $menu == 'coverage' ? 'class="active"' : ''?>><a href="coverage">Cobertura en tu país</a></li>
  <li <?php echo $menu == 'world' ? 'class="active"' : ''?>><a href="world">Datos Mundo</a></li>
</ul>