@includeIf('layouts.head')
      <div class="flex items-center" style="background: #ffffff;">
          <div style="padding: 5em 0; margin-right:auto; margin-left:auto;">
              <div class="card card-compact bg-primary-content shadow-xl" style="width:23em;">
                  <div class="card-body">
                      {{ $slot }}
                  </div>
              </div>
          </div>
      </div>
@includeIf('layouts.foot')
