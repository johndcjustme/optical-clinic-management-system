<table {{ $attributes->merge(['class' => 'table w-full']) }}>
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



  