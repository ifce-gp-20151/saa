# Tarefas (Issues)

Veja as tarefas disponíveis em: <https://github.com/ifce-gp-20151/saa/issues>

\begin{figure}[H]
	\includegraphics[scale=0.4]{img/issues.png}
	\caption{Página de issues}
\end{figure}

Clique na tarefa que deseja resolver e indique que você irá resolver.

\begin{figure}[H]
	\includegraphics[scale=0.4]{img/resolver-issue.png}
	\caption{Resolver issue}
\end{figure}

Verifique o número da issue. Ela vai ser o nome do seu _branch_ local.

\begin{figure}[H]
	\includegraphics[scale=0.5]{img/numero-issue.png}
	\caption{Número da issue}
\end{figure}

# Branch no repositório local

Entre em seu repositório local pelo terminal e crie o branch de acordo com o número da issue.

~~~
git checkout master
git fetch origin
git merge origin/master
git checkout -b issue-11
~~~

Começe a trabalhar normalmente.

Verifique a pasta `./docs/manual/workflow-zend`.

# Finalizar tarefa

Ao finalizar a tarefa você deve fazer _commit_ de suas alterações. Para facilitar use o `gitg`.
Para utilizar basta executar no seu repositório local `gitg`.

\begin{figure}[H]
	\includegraphics[scale=0.4]{img/gitg.png}
	\caption{gitg}
\end{figure}

Verifique se o _branch_ está correto:

\begin{figure}[H]
	\includegraphics[scale=1.0]{img/gitg-branch.png}
	\caption{Branch}
\end{figure}

**Obs.:** no exemplo está com outro nome, mas no caso deveria ter o valor **issue-11**.

## Commit das alterações

Para fazer o _commit_ clique na aba Commit. Coloque os arquivos necessários de
_Unstaged_ para _Staged_. Por fim escreva a mensagem de _commit_, e clique no botão **Commit**:

\begin{figure}[H]
	\includegraphics[scale=0.4]{img/gitg-commit.png}
	\caption{Commit}
\end{figure}

Feche o `gitg`.

# Atualizar com o código Remoto

Antes de subir as alterações é necessário atualizar a base com o repositório remoto.
Para isso faça:

~~~
git checkout master
git fetch origin
git merge origin/master
~~~

Logo depois faça o _merge_ com o seu _branch_:

~~~
git checkout master
git merge issue-11
~~~

A saída será algo como:

~~~
Updating f42c576..3a0874c
Fast-forward
 index.html | 2 ++
 1 file changed, 2 insertions(+)
~~~

Verifique se `Fast-foward` aparece na mensagem. Isso quer dizer:
"Ok, tudo certo para subir o código!".

~~~
git push -u origin master
~~~

## Conflitos!

Podem acontecer conflitos ao fazer o _merge_, ou seja, seu código possui linhas de código
modificadas no mesmo local que as do repositório remoto. Quando isso acontecer ao fazer
o _merge_ a saída será algo como:

~~~
Auto-merging index.html
CONFLICT (content): Merge conflict in index.html
Automatic merge failed; fix conflicts and then commit the result.
~~~

A frase final indica:

> Merge automático falhou; resolva os conflitos e então faça commit do resultado.

Para resolver os conflitos use o `meld`. Instalação:

~~~
sudo apt-get install meld
~~~

Em seguida dento do seu repositório local execute:

~~~
git mergetool
~~~

Uma mensagem semelhante a essa irá aparecer, apenas dê `Enter`.

~~~
This message is displayed because 'merge.tool' is not configured.
See 'git mergetool --tool-help' or 'git help config' for more details.
'git mergetool' will now attempt to use one of the following tools:
opendiff meld tortoisemerge bc3 codecompare vimdiff emerge
Merging:
index.html

Normal merge conflict for 'index.html':
  {local}: modified file
  {remote}: modified file
Hit return to start merge resolution tool (meld):
~~~

\begin{figure}[H]
	\includegraphics[scale=0.35]{img/meld3.png}
	\caption{Meld}
\end{figure}

Esse é o chamado _Three way git merging_, ou merge de três vias. O arquivo a esquerda é
seu arquivo local, o do meio é o arquivo que é ancestral, e o da direita o arquivo remoto.

Coloque todas as alterações para o arquivo do meio, clicando na `seta`. Clique no `X`
para apagar. Segure `Ctrl` para colocar o código abaixo ou acima do indicado, assim
é possível juntar algo do seu _branch_ com o do _branch_ remoto.

Caso tenha acontecido conflitos em mais de um arquivo, ao fechar o `meld` basta
continuar dando `Enter`.











