function Convert(bedrag, conversie)
{
    var doeuKoers = 0.74;
    var eudoKoers = 1.36;
    var rueuKoers = 0.02;
    var euruKoers = 48.40;
    bedrag = parseInt(bedrag)

    switch (conversie)
    {
        case "doeu":
            bedragConvert = bedrag * doeuKoers
            document.write(bedrag + " dollar voor " + bedragConvert + " euro")
            break  
        case "eudo":
            bedragConvert = bedrag * eudoKoers
            document.write(bedrag + " euro voor " + bedragConvert + " dollar")
            break  
        case "rueu":
            bedragConvert = bedrag * rueuKoers
            document.write(bedrag + " rubles voor " + bedragConvert + " euro")
            break  
        case "euru":
            bedragConvert = bedrag * euruKoers
            document.write(bedrag + " euro voor " + bedragConvert + " rubles")
            break         
    }
    
}