import React, { useEffect, useState } from 'react';
import axios from 'axios';

const NewCharacter = () => {

    const [gender, setGender] = useState([]);
    const [forum, setForum] = useState([]);
    const [name, setName] = useState([]);
    const [prenom, setPrenom] = useState([]);
    const [age, setAge] = useState([]);
    const [chosengender, setChosengender] = useState([]);
    const [chosenForum, setChosenforum] = useState([]);

    async function sendForm(){

    try {
        await axios({
            method: 'POST',
            url: 'http://localhost:8787/characters/add',
            data:{
                nom: name,
                prenom: prenom,
                age: age,
                gender: chosengender,
                forum:chosenForum
        }
        })

    } catch (error){

        console.log(error);
    }
}



useEffect(() => {
        async function getGenders(){

        const res = await axios.get('http://localhost:8787/genders');
        const stuff = await res.data;
        
        setGender(stuff);
        console.log(gender);
    
    };
    
    async function getForums(){

        const res = await axios.get('http://localhost:8787/forums');
        const stuff = await res.data;
        
        setForum(stuff);
        console.log(forum);
    
    } 
    getGenders();
    getForums();
}, []);

    return (
        <>
            <h2>Add a new character</h2>
            <form method="post" onSubmit={(e) => e.preventDefault()}>
            <label htmlFor="name">Name</label>
            <input name="name" type="text" onChange={(e) => setName(e.target.value)}/>
            <label htmlFor="prenom">Firstname</label>
            <input name="prenom" type="text" onChange={(e) => setPrenom(e.target.value)}/>
            <label htmlFor="age" type='number' inputMode='numeric'>Age</label>
            <input type='number' inputMode='numeric' onChange={(e) => setAge(e.target.value)}></input>
            <label htmlFor="gender">Gender</label>
            <select onChange={(e) => setChosengender(e.target.value)}>
                <option value="0">Select a gender identity</option>
                {
                gender.map((a,index) => <option key={index} value={a.id}>{a.gender}</option>
                )
                }
            </select>
            <label htmlFor="forum">Forum</label>
            <select onChange={(e) => setChosenforum(e.target.value)}>
                <option value="0">Select a forum</option>
                {
                forum.map((a,index) => <option key={index} value={a.id}>{a.forum_name}</option>
                )
            }
            </select>
            <button type="submit" onClick={(e) => sendForm()}>Create character</button>
            </form>
        </>
    );
};

export default NewCharacter;