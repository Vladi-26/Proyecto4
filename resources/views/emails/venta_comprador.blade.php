<h1>Hola, {{ $venta->comprador->nombre }}</h1>
<p>Tu compra con folio #{{ $venta->id }} ha sido validada por el administrador.</p>
<p>Total pagado: ${{ $venta->total }}</p>