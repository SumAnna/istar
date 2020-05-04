<h1><a id="user-content-pat-phy-dep-site" class="anchor" aria-hidden="true" href="#pat-phy-dep-site"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Pat Phy Dep site</h1>
<h3><a id="user-content-intsalling-project" class="anchor" aria-hidden="true" href="#intsalling-project"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Intsalling project</h3>
<p>Create project directory</p>
<blockquote>
<p>mkdir istart</p>
</blockquote>
<p>Clone remote project from GitHub</p>
<blockquote>
<p>git clone <a href="https://github.com/sumtsow/pat">https://github.com/SumAnna/istar</a></p>
</blockquote>
<p>Set project directory as current</p>
<blockquote>
<p>cd pat</p>
</blockquote>
<p>Load requred dependecies by Composer</p>
<blockquote>
<p>composer update</p>
</blockquote>
<p>On Linux set write permissions to <em><strong>storage</strong></em> directory recursively. On Windows use GUI if required.</p>
<blockquote>
<p>chmod 777 storage -R</p>
</blockquote>
<p>Make new <em><strong>.env</strong></em> file to Environment Options</p>
<p>On Linux</p>
<blockquote>
<p>cp .env.example .env</p>
</blockquote>
<p>On Windows</p>
<blockquote>
<p>copy .env.example .env</p>
</blockquote>
<p>Set Environment Options in <em><strong>.env</strong></em> file (for example)</p>
<blockquote>
<p>APP_NAME=Laravel</p>
</blockquote>
<blockquote>
<p>DB_DATABASE=your_database</p>
</blockquote>
<blockquote>
<p>DB_USERNAME=your_database_user</p>
</blockquote>
<blockquote>
<p>DB_PASSWORD=your_database_password</p>
</blockquote>
<p>Generate new Key File</p>
<blockquote>
<p>php artisan key:generate</p>
</blockquote>
<p>Create new database for project and if nessesary create new users with database permissions. You can use any MySQL client or PhpMyAdmin</p>
<p>Migrate Database using Artisan</p>
<blockquote>
<p>php artisan migrate</p>
</blockquote>
<p>and seed test data</p>
<blockquote>
<p>php artisan db:seed</p>
</blockquote>
<p>Make Symlink from <em><strong>/storage/app/public</strong></em> to <em><strong>/public/storage</strong></em></p>
<blockquote>
<p>php artisan storage:link</p>
</blockquote>
<p><strong>Intallation complete</strong>.</p>
<p>Start your Laravel development server</p>
<blockquote>
<p>php artisan serve</p>
</blockquote>
<p>There are some test database data on SQL format in <em><strong>/database/sql</strong></em> directory.</p>
