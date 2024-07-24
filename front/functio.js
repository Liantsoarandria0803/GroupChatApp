fetch("../data/user.json")
 .then(resp=>resp.json())
 .then(data =>{
    document.getElementById("user").innerHTML=`BIENVENUE ${data.userName}`
    document.getElementById("envoi").innerHTML=`
    <input type="hidden" name="userId" value="${data.userId}">
    <input type="hidden" name="username" value="${data.userName}">
    <textarea name="message" id="textEnv" placeholder="message..." required></textarea>
    <button type="submit" id="envoyer">ENVOYER</button>
    `
    fetch("../data/messageAPi.php").then(rep=>rep.json()).then(Mess=>{
      const MessageList=Mess["message"]
        let messageBox=document.getElementById("MessBox")
        let listBox=""
        for(i=0;i<MessageList.length;i++){
         if(MessageList[i].username===data.userName){
            listBox+=` <div id="mess1">
            <div id=users>
               Vous
            </div>
            <div id=messageB>
             <p>
               ${MessageList[i].mess}
               </p>
            </div>
         </div>`
         }
         else{
            listBox+=` <div id="mess1other">
                        <div id=users>
                           ${MessageList[i].username}
                        </div>
                        <div id=messageBother>
                           <p>
                           ${MessageList[i].mess}
                           </p>
                        </div>
                     </div>`
         }
      }
      messageBox.innerHTML=listBox
    })
 })