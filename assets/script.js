let del = document.querySelectorAll(".del");
        let edit = document.querySelectorAll(".edit");
        del.forEach(e => {
            e.addEventListener("click", () => {
                window.location.href = "index.php?del="+e.parentElement.parentElement.children[0].textContent;
            })
        })
        edit.forEach(e => {
            e.addEventListener("click", () => {
                window.location.href = "index.php?edit="+e.parentElement.parentElement.children[0].textContent+"";
            })
        })

        if(id != null){
            const rows = document.querySelectorAll('tr');
            let arr = [];
            rows.forEach(row => {
                arr.push(row.children[0].textContent);
            })
            arr.forEach(i => {
                if(i == id){
                    rows.forEach(row => {
                        if(row.children[0].textContent == id){
                            for(let e = 1; e<=3; e++){
                                let input = document.createElement('input');
                                input.setAttribute("type", "text");
                                input.classList.add("atualizar");
                                input.id = e;
                                row.children[e].innerHTML = "";
                                row.children[e].append(input);
                            }

                            document.querySelectorAll(".atualizar")[1].setAttribute("type", "date");
                            document.querySelectorAll(".atualizar")[2].setAttribute("type", "number");

                            row.children[4].innerHTML = "";
                            let button = document.createElement('button');
                            button.innerHTML = "enviar";
                            button.id = "enviar"
                            row.children[4].append(button)

                            document.querySelector("#enviar").addEventListener('click', () => {
                                const novosDadosBruto = document.querySelectorAll(".atualizar");
                                let novosDadosRef = [];
                                let arr = [];

                                novosDadosBruto.forEach(i => {
                                    arr.push(i);
                                })

                                arr.forEach(i => {
                                    if(i.value != ""){
                                        novosDadosRef.push([i.value, i.id]);
                                    }
                                })

                                let query = `UPDATE aluno SET `
                                for(let i = 0; i<novosDadosRef.length; i++){
                                    if(novosDadosRef.length == 1){
                                        if(novosDadosRef[i][1] == 1){
                                            query += "nome='"+novosDadosRef[i][0]+"'"
                                        } else if(novosDadosRef[i][1] == 2){
                                            query += "nascimento='"+novosDadosRef[i][0]+"'"
                                        } else if(novosDadosRef[i][1] == 3){
                                            query += "renda="+novosDadosRef[i][0]
                                        }
                                    } else {
                                        if(novosDadosRef[i][1] == 1){
                                            query += "nome='"+novosDadosRef[i][0]+"',"
                                        } else if(novosDadosRef[i][1] == 2){
                                            query += "nascimento='"+novosDadosRef[i][0]+"',"
                                        } else if(novosDadosRef[i][1] == 3){
                                            query += "renda="+novosDadosRef[i][0]+","
                                        }
                                    }
                                }

                                if(novosDadosRef.length >= 2){
                                    query = query.substring(0, query.length-1)
                                }
                                query += " WHERE id="+id
                                console.log(query) // só preciso mandar isso pro php, vou fazer isso da maneira mais burra
                                window.location.href = "index.php?query="+query;

                            })
                        }
                    })
                }
            })
        }