<table {{ $attributes->merge(['class' => 'ui single line table']) }}>
  <thead>
    <tr>
      {{ $thead }}
    </tr>
  </thead>
  <tbody>
      {{ $tbody }}
  </tbody>
  <tfoot>
      {{ $tfoot ?? null }}
  </tfoot>
</table>



  