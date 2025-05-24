from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer
analyser = SentimentIntensityAnalyzer()
text  = 'the teacher is arrogant '
print (analyser.polarity_scores(text))
