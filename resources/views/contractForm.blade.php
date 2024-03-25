<div class="parentDiv">
    {{-- info div  --}}
    <div class="info">
        <h1 class ="infoH1">
            Consulting <br /> Agreement
        </h1>
        <section class ="section">
            {{-- -------------------------------------- --}}
            <p class ="sectionTitle">Parties</p>
            <p class ="sectionInfo">
                - This Servicde Contract Agreement (here in after Referred to as the
                <span class ="font-bold">"Agreement"</span> ) is entered into on
                <input name="input1" onChange={handleInputChange} class ="sectionInput" type="text" />
                ( the <span class ="font-bold">"Effective Date"</span>).by and
                Between
                <input name="input2" onChange={handleInputChange} class ="sectionInput" type="text" />
                with an address of
                <input name="input3" onChange={handleInputChange} class ="sectionInput" type="text" />
                (here in after referred to as the
                <span class ="font-bold">"Client"</span> )(colletively referred
                as the <span class ="font-bold">"parties"</span>)
            </p>
            {{-- --------------------------------------  --}}
            <p class ="sectionTitle">Consideration</p>
            <p class ="sectionInfo">
                - The Parties agree that the Consultant provide the service attached
                here under. whereas the Client will in return provide compensation
                for such service and expertise.
            </p>
            {{-- --------------------------------------  --}}
            <p class ="sectionTitle">Service</p>
            <p class ="sectionInfo">
                - The Consultant's service summarized down below: <br />
                <span class ="flex">
                    1.
                    <input name="input4" onChange={handleInputChange} class ="ServiceInput " type="text" />
                </span>
                <span class ="flex">
                    2.
                    <input name="input5" onChange={handleInputChange} class ="ServiceInput " type="text" />
                </span>
                <span class ="flex">
                    3.
                    <input name="input6" onChange={handleInputChange} class ="ServiceInput " type="text" />
                </span>
                <span class ="flex">
                    4.
                    <input name="input7" onChange={handleInputChange} class="ServiceInput " type="text" />
                </span>
                <span class ="flex">
                    5.
                    <input name="input8" onChange={handleInputChange} class="ServiceInput " type="text" />
                </span>
                <span class="flex">
                    6.
                    <input name="input9" onChange={handleInputChange} class="ServiceInput " type="text" />
                </span>
            </p>
            {{-- --------------------------------------  --}}
            <p class="sectionTitle">Consideration</p>
            <p class="sectionInfo">
                - A fee of
                <input name="input10" onChange={handleInputChange} class="sectionInput" type="text" />
                will be invoice to CLient by the Consultant on the first day of
                every month for all the services provided and performed as will as
                for all the pre-approved expenses incurred the previous month.
                <br />- The Client is required to pay the invoice within
                <input name="input11" onChange={handleInputChange} class="sectionInput" type="text" />
                days upon receiving it. <br />- The Parties agree that the payments
                are to be made via
                <input name="input12" onChange={handleInputChange} class="sectionInput" type="text" />
                and sent to the following address <br />
                <input name="input13" onChange={handleInputChange} class="ConsiderationInput" type="text" />
            </p>
        </section>
    </div> 
</div>
{{-- submit button ------------------------------  --}}
<div class="submitDiv mb-[50px]">
    <Link to="/confirmContractPage">

    <button onClick={handleSubmit} class="submit">
        Submit
    </button>
    </Link>
</div>
{{-- submit button ------------------------------ --}}
{{-- css section --}}
 parentDiv  {
    bord
 }

<style>
    @media (min-width: 960px) {
        .parentDiv {
            margin: 50px;
        }
    }

    @media (min-width: 720px) {
        .parentDiv {
            margin: 20px;
        }
    }
    .parentDiv {
    border-style: solid; 
    border-color: #25476a; 
    border-width: 10px;
}

    /* info  */
    .infoH1 {
        text-align: center;
        font-family: "Taviraj, serif";
        text-transform: uppercase;
        font-size: 36px;
        line-height: 40px;
        font-weight: 600;
        margin-top: 50px;
        margin-bottom: 50px;
    }

    @media (min-width: 960px) {
        .info {
            margin: 20px;
        }
    }

    @media (min-width: 720px) {
        .info {
            margin: 20px;
        }
    }

    /* ---------------------------------------- */
    .font-bold {
        font-weight: 700;
    }

    .section {
        margin-right: 50px;
        margin-left: 50px;
        margin-bottom: 50px;
    }

    .sectionTitle {
        text-transform: uppercase;
        font-size: 20px;
        line-height: 28px;
        font-weight: 600;
        text-decoration: underline;
        margin-top: 20px;
    }

    .sectionInfo {
        margin-top: 10px;
        line-height: 40px
    }

    .sectionInput {
        width: 150px;
        outline: none;
        background-color: transparent;
        padding: 4px 12px;
        border: none;
        border-bottom: 2px solid black;
    }
    .ServiceInput {
        width: 1000px;
        outline: none;
        background-color: transparent;
        padding: 4px 12px;
        border: none;
        border-bottom: 2px solid black;
    }

    .ConsiderationInput {
        width: 100%;
        outline: none;
        background-color: transparent;
        padding: 4px 12px;
        border: none;
        border-bottom: 2px solid black;
    }


    .flex {
        display: flex;

    }

    /* submit button  */
    .submitDiv {
        display: flex;
        justify-content: center;
    }

    .submit {
        text-align: center width: 60px;
        height: 50px;
        border-radius: 10px;
        background-color: #25476a;
        color: white;
        border: 1px solid black;
    }

    .submit:hover {
        box-shadow: 0px 0px 10px black;
    }
</style>
