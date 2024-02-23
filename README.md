# zeusayuda0224

Archivos modificados (dentro del tema zeusdocs):

js > scripts-zeusdocs.js
Se agrego un script para que cuando se abre una pagina o subpagina, el menu lateral se muestre desplegado en el contenedor de esa pagina.
![imagen](https://github.com/franimpo/zeusayuda0224/assets/23081830/814e4276-0a27-4945-879f-55ced754575c)


css > styles-zeusdocs.js
Se modificaron estilos varios

template-parts > menu-sidebartest.php
Es la barra lateral modificada para no tocar la original, para hacerla funcionar hay que ir a page.php (o crear una copia y usarla como template de una pagina) y cambiar el link del template-part de sidebar a sidebartest.
El loop que lista las paginas y subpaginas ahora esta hecho de otra manera y puede incluir todas las subppaginas y subniveles que sean necesarios.
![Sin título-1](https://github.com/franimpo/zeusayuda0224/assets/23081830/bd88612c-ae78-4fa6-87df-e4383d70bf64)


template-parts > content-page.php
En la barra de navegacion de arriba (breadcrumb) se agrego un link para la pagina superior, antes no estaba linkeada.
![Sin título](https://github.com/franimpo/zeusayuda0224/assets/23081830/11e7d560-edac-492c-a0a4-2fd7316b299c)

Ahora la página si no tiene contenido, en lugar de mostrarse vacia muestra o la lista de subpaginas, o muestra un mensaje de "En construcción"
![Sin título-1](https://github.com/franimpo/zeusayuda0224/assets/23081830/3c23c964-19a5-452c-81b1-facce0d69993)
![Sin título](https://github.com/franimpo/zeusayuda0224/assets/23081830/6c3e282d-899c-4f86-984b-8121ec9f16ad)


