<style>
    body {
        position: relative;
    }

    @font-face {
        font-family: Nazanin;
        src: url('../School/Font/BNAZANIN.TTF');
    }

    .LinkFooter{
        text-decoration: underline;
        color: white;
    }

    footer {
        position: absolute;
        bottom: 0px;
        width: 100%;
        max-width: 1800px;
        box-sizing: border-box;
        padding: 20px;
        color: white;
        background-image: url('../School/Data/footer.jpg');
        text-decoration: none;
        font-family: Nazanin;
        font-size: 23px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    footer ::selection {
        background-color: white;
        color: rgb(0, 108, 161);
    }

    @media screen and (max-width:1200px) {
        footer {
            background-image:url('../School//Data/footerMobile.jpg');
        }
    }

    @media screen and (max-width:700px) {
        footer {
            width: 100%;
        }

        .onlineclass-div-footer {
            display: none;
        }
    }
</style>
<footer dir="rtl">
    <div>
        <p>درباره ما :</p>
        <p style="margin-right: 20px;">شماره تلفن مدرسه : <a style="color: white;" href="tel:08133348086">02112456</a></p>   
        <p style="margin-right: 20px;">شماره تلفن مدیر : <a style="color: white;" href="tel:09189500469">09127654766</a></p>   
        <p style="margin-right: 20px;">آدرس : گاندی، جنب کوچه صدف.</p>
    </div>
    <div class="onlineclass-div-footer">
        <p style="margin-left: 100px;">گروه مدرسه  : </p>
        <a style="margin-left: 70px; text-decoration: none" target="_blank" class="LinkFooter" title="علامه حلی ملایر" href="#">HelliM@</a>
    </div>
</footer>

<a href="tel:0215453332"></a>
<a href="tel:0912676001"></a>
